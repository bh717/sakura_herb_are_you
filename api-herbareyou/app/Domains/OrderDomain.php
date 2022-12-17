<?php

namespace App\Domains;

use App\Enums\OrderStatus;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductPrice;
use App\Models\User;
use App\Models\UserDeliveryLocation;
use Illuminate\Database\Eloquent\Collection;

class OrderDomain extends BaseDomain
{
    private $order;
    private $orderDetail;
    private $user;
    private $userDeliveryLocation;
    private $productPrice;

    public function __construct(
        Order $order,
        OrderDetail $orderDetail,
        User $user,
        UserDeliveryLocation $userDeliveryLocation,
        Coupon $coupon,
        ProductPrice $productPrice
    ) {
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->user = $user;
        $this->userDeliveryLocation = $userDeliveryLocation;
        $this->productPrice = $productPrice;
        $this->coupon = $coupon;
    }

    public function createOrder(
        int $userId,
        ?string $deliveredAt,
        array $cartData
    ): Order {
        $user = $this->user->find($userId);
        $userDeliveryLocationRow = $this->userDeliveryLocation
            ->where('user_id', $userId)
            ->first();
        $order = $this->order->create([
            // クーポン
            'coupon_id' => $cartData['coupon_id'],
            'coupon_name' => $cartData['coupon_name'],
            'coupon_code' => $cartData['coupon_code'] === '' ? null : $cartData['coupon_code'],
            'coupon_discount_price' => $cartData['coupon_discount_price'],
            // ユーザー
            'user_id' => $userId,
            'user_email' => $user->email,
            'user_last_name' => $user->last_name,
            'user_first_name' => $user->first_name,
            'user_last_name_kana' => $user->last_name_kana,
            'user_first_name_kana' => $user->first_name_kana,
            'user_birthday' => $user->birthday,
            'user_zip' => $user->zip,
            'user_address1' => $user->address1,
            'user_tel1' => $user->tel1,
            // お届け場所
            'user_delivery_location_id' => $userDeliveryLocationRow->id,
            'user_delivery_location_last_name' => $userDeliveryLocationRow->last_name,
            'user_delivery_location_first_name' => $userDeliveryLocationRow->first_name,
            'user_delivery_location_last_name_kana' => $userDeliveryLocationRow->last_name_kana,
            'user_delivery_location_first_name_kana' => $userDeliveryLocationRow->first_name_kana,
            'user_delivery_location_zip' => $userDeliveryLocationRow->zip,
            'user_delivery_location_address1' => $userDeliveryLocationRow->address1,
            'user_delivery_location_tel1' => $userDeliveryLocationRow->tel1,
            // その他
            'delivered_at' => $deliveredAt,
            'status' => OrderStatus::TEMP_PURCHASE,
            // 金額
            'total_num' => $cartData['total_num'],
            'total_product_price' => $cartData['total_product_price'],
            'total_product_include_tax' => $cartData['total_product_include_tax'],
            'total_product_include_tax_rate' => $cartData['total_product_include_tax_rate'],

            'total_delivery_charge' => $cartData['total_delivery_charge'],
            'total_delivery_charge_include_tax' => $cartData['total_delivery_charge_include_tax'],
            'total_delivery_charge_include_tax_rate' => $cartData['total_delivery_charge_include_tax_rate'],

            'fee' => $cartData['fee'],
            'fee_include_tax' => $cartData['fee_include_tax'],
            'fee_include_tax_rate' => $cartData['fee_include_tax_rate'],

            'total_price' => $cartData['total_price'],
            // 'total_include_tax' => $cartData['total_include_tax'],
        ]);
        $order->order_no = uniqid($order->id);
        $order->saveOrFail();
        return $order;
    }

    public function createOrderDetails(
        int $orderId,
        array $cartDetailData
    ): array {
        $productPriceIds = [];
        foreach ($cartDetailData as $cartDetail) {
            $productPriceIds[] = $cartDetail['product_price']['id'];
        }
        $productPrices = $this->productPrice
            ->with([
                'product.category',
                'product.keywords',
                'product.materials',
                'product.prices',
                'product.symptoms',
                'product.tastes',
                'product.uploadFiles',
            ])
            ->whereIn(
                'id',
                $productPriceIds
            )
            ->get()
            ->keyBy('id');

        // 現在の商品の値段で作成している
        $orderDetails = [];
        foreach ($cartDetailData as $cartDetail) {
            $product = $productPrices[$cartDetail['product_price']['id']]->product;

            $orderDetails[] = $this->orderDetail->create([
                'order_id' => $orderId,
                // 商品
                'product_category_id' => $product->category->id,
                'product_id' => $product->id,
                'product_category_name' => $product->category->name,
                'product_category_series_name' => $product->category->series_name,
                'product_no' => $product->product_no,
                'product_name1' => $product->name1,
                'product_name2' => $product->name2,
                'product_description' => $product->description,
                'product_capacity' => $product->capacity,
                // product_price
                'product_price_id' => $cartDetail['product_price']['id'],
                'product_include_tax' => $cartDetail['product_price']['include_tax'],
                'product_price' => $cartDetail['product_price']['price'],
                'product_price_capacity' => $cartDetail['product_price']['capacity'],
                // カテゴリなど
                'symptom_id_csv' => implode(',', $product->symptoms->pluck('id')->toArray()),
                'taste_id_csv' => implode(',', $product->tastes->pluck('id')->toArray()),
                'material_id_csv' => implode(',', $product->materials->pluck('id')->toArray()),
                'keyword_id_csv' => implode(',', $product->keywords->pluck('id')->toArray()),
                'symptom_name_csv' => implode(',', $product->symptoms->pluck('name')->toArray()),
                'taste_name_csv' => implode(',', $product->tastes->pluck('name')->toArray()),
                'material_name_csv' => implode(',', $product->materials->pluck('name')->toArray()),
                'keyword_name_csv' => implode(',', $product->keywords->pluck('keyword')->toArray()),
                // 購入情報
                'num' => $cartDetail['num'],
                'sub_total' => $cartDetail['product_price']->price * $cartDetail['num'],
            ]);
        }
        return $orderDetails;
    }

    public function canOrderByUserId(int $userId): bool
    {
        return $this->cart
            ->where('user_id', $userId)
            ->exists();
    }

    public function getOrderDetailsByUserId(int $userId): Collection
    {
        return $this->orderDetail
            ->whereHas('order', function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->where('status', '!=', OrderStatus::TEMP_PURCHASE)
                    ->where('status', '!=', OrderStatus::FAILED)
                    ->where('status', '!=', OrderStatus::CANCEL);
            })
            ->get();
    }

    public function getOrderById(int $id): ?Order
    {
        return $this->order->find($id);
    }

    public function getOrderByOrderNo(string $orderNo): ?Order
    {
        return $this->order
            ->where('order_no', $orderNo)
            ->first();
    }

    public function getOrderDetailsByOrderId(int $orderId): Collection
    {
        return $this->orderDetail
            ->where('order_id', $orderId)
            ->ger();
    }

    private function getOrderSearchQuery($query, array $search)
    {
        if (isset($search['order_by']) && $search['order_by'] === 'order_id_desc') {
            $query = $query->orderBy('orders.id', 'desc');
        }
        return $query;
    }

    public function orderPaginate(array $search = [])
    {
        $perPage = $this->getPerPage($search);
        $query = $this->order;
        return $perPage !== -1
            ? $this->getOrderSearchQuery($query, $search)
                ->paginate($perPage)
            : $this->getOrderSearchQuery($query, $search)
                ->get();
    }

    public function updateStatus(int $id, int $status): void
    {
        $order = $this->order->find($id);
        $order->status = $status;
        $order->saveOrFail();
        if ($order->sentStatus()) {
            $order->send_date_time = now();
            $order->saveOrFail();
        }
    }

    public function updateOrderIsPaymentAndTransCode(
        string $orderNo,
        bool $isPayment,
        string $transCode
    ): void {
        $order = $this->order->where('order_no', $orderNo)->first();
        $order->is_payment = $isPayment;
        $order->status = OrderStatus::WAITING_SEND;
        $order->epsilon_trans_code = $transCode;
        $order->saveOrFail();
    }

    public function failedOrderByOrderId(
        int $orderId
    ): void {
        $this->order->find($orderId)->update([
            'status' => OrderStatus::FAILED,
        ]);
    }
}
