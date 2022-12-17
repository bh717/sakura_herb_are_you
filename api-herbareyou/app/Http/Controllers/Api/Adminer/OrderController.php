<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\OrderDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\OrderUpdateDeliveryLocationRequest;
use App\Http\Requests\Api\Adminer\OrderUpdateStatusRequest;
use App\Http\Resources\Adminer\OrderCollection;
use App\Http\Resources\Adminer\OrderResource;
use App\Mail\User\SentProduct;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mail;

class OrderController extends BaseController
{
    private $orderDomain;

    public function __construct(
        OrderDomain $orderDomain
    ) {
        parent::__construct();
        $this->orderDomain = $orderDomain;
    }

    public function index(Request $request): OrderCollection
    {
        $search = $request->input();
        $orders = $this->orderDomain->orderPaginate($search);
        $orders->load([
            'user',
            'details.product.category',
            'details.product.keywords',
            'details.product.materials',
            'details.product.prices',
            'details.product.symptoms',
            'details.product.tastes',
        ]);
        return new OrderCollection($orders);
    }

    public function show(Order $order): OrderResource
    {
        $order->load([
            'user',
            'details.product.category',
            'details.product.keywords',
            'details.product.materials',
            'details.product.prices',
            'details.product.symptoms',
            'details.product.tastes',
        ]);
        return new OrderResource($order);
    }

    public function updateStatus(OrderUpdateStatusRequest $request, Order $order): JsonResponse
    {
        $this->orderDomain->updateStatus($order->id, $request->status);
        $order = $this->orderDomain->getOrderById($order->id);
        // 発送済み
        if ($order->sentStatus()) {
            Mail::to($order->user)->send(new SentProduct($order->id));
        }
        return $this->sendResponse();
    }

    public function updateDeliveryLocation(
        OrderUpdateDeliveryLocationRequest $request,
        Order $order
    ): OrderResource {
        $order->user_delivery_location_last_name = $request->user_delivery_location_last_name;
        $order->user_delivery_location_first_name = $request->user_delivery_location_first_name;
        $order->user_delivery_location_last_name_kana = $request->user_delivery_location_last_name_kana;
        $order->user_delivery_location_first_name_kana = $request->user_delivery_location_first_name_kana;
        $order->user_delivery_location_zip = $request->user_delivery_location_zip;
        $order->user_delivery_location_address1 = $request->user_delivery_location_address1;
        $order->user_delivery_location_tel1 = $request->user_delivery_location_tel1;
        $order->saveOrFail();
        return $this->show($order);
    }
}
