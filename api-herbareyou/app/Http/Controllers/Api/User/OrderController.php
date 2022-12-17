<?php

namespace App\Http\Controllers\Api\User;

use App\Domains\CartDomain;
use App\Domains\EpsilonDomain;
use App\Domains\OrderDomain;
use App\Enums\EpsilonResult;
use App\Enums\EpsilonState;
use App\Enums\OrderStatus;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\User\OrderConfirmRequest;
use App\Http\Requests\Api\User\OrderStoreRequest;
use App\Mail\User\OrderStoreToUser;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Mail;

class OrderController extends BaseController
{
    private $orderDomain;
    private $epsilonDomain;
    private $cartDomain;

    public function __construct(
        OrderDomain $orderDomain,
        EpsilonDomain $epsilonDomain,
        CartDomain $cartDomain
    ) {
        parent::__construct();
        $this->orderDomain = $orderDomain;
        $this->epsilonDomain = $epsilonDomain;
        $this->cartDomain = $cartDomain;
    }

    public function store(OrderStoreRequest $request): JsonResponse
    {
        $userId = auth()->user()->id;
        $orderData = DB::Transaction(function () use ($userId, $request) {
            $cartData = $this->cartDomain->getCartData($request->product_prices, $request->coupon_code);
            $newOrder = $this->orderDomain->createOrder($userId, $request->delivered_at, $cartData['cart']);
            $this->orderDomain->createOrderDetails($newOrder->id, $cartData['cart_details']);
            $redirectUrl = $this->epsilonDomain->getPaymentUrl($newOrder->id);
            $order = $this->orderDomain->getOrderById($newOrder->id);
            $order->load(['details']);
            return [
                'order' => $order,
                // 'order_details' => $newOrderDetails,
                'redirect_url'  => $redirectUrl,
            ];
        });
        return $this->sendResponse($orderData);
    }

    public function getDeliveredAtList(): JsonResponse
    {
        $date = [];
        for ($i = 0; $i < 30; $i++) {
            $d = (new Carbon("+ {$i}day"))->format('Y-m-d');
            $date[] = $d;
        }
        return $this->sendResponse($date);
    }

    public function confirm(OrderConfirmRequest $request): JsonResponse
    {
        $getSalesData = $this->epsilonDomain->getSales($request->trans_code);
        $order = $this->orderDomain->getOrderByOrderNo($request->order_no);
        if (!$this->checkMyOrder($getSalesData['order_number'], $request->order_no, $order)) {
            \Log::error('注文データ確認に失敗しました');
            \Log::error('trans_code: ' . $request->trans_code . ', order_no: ' . $request->order_no . '購入処理に失敗しました');
            throw new \Exception('購入処理に失敗しました');
        }
        // 失敗
        if ($request->result == EpsilonResult::FAILED) {
            $this->orderDomain->failedOrderByOrderId($order->id);
            return $this->sendResponse(null, 204);
        }
        // 現在の購入処理反映
        $isPayment = isset($getSalesData['state']) && ($getSalesData['state'] !== EpsilonState::CANCEL);
        $this->orderDomain->updateOrderIsPaymentAndTransCode($request->order_no, $isPayment, $request->trans_code);
        // メール送信
        Mail::to(auth()->user())->send(new OrderStoreToUser($order->id));
        return $this->sendResponse([
            'is_payment' => $isPayment,
        ]);
    }

    private function checkMyOrder(
        string $epsilonOrderNumber,
        string $requestOrderNo,
        ?Order $order
    ): bool {
        // 自分のオーダーかチェック
        if ($epsilonOrderNumber !== $requestOrderNo) {
            return false;
        }
        if (is_null($order) || auth()->id() !== $order->user_id || $order->status !==  OrderStatus::TEMP_PURCHASE) {
            return false;
        }
        return true;
    }

    public function cancelOrder()
    {
    }
}
