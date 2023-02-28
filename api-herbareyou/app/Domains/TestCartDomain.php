<?php

namespace App\Domains;

use App\Enums\IsDelete;
use App\Http\Resources\User\TrialProductResource;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\ProductPrice;

class TestCartDomain extends BaseDomain
{
    private $coupon;
    private $productPrice;

    public function __construct(
        Coupon $coupon,
        ProductPrice $productPrice
    ) {
        $this->coupon = $coupon;
        $this->productPrice = $productPrice;
    }

    private function defaultCartInfo(): array
    {
        return [
            // 商品
            'total_product_price' => 0,
            'total_product_include_tax' => 0,
            'total_product_include_tax_rate' => config('order.product_tax_rate') * 100,
            // 送料
            'total_delivery_charge' => config('order.delivery_charge'),
            'total_delivery_charge_include_tax'
                => Order::totalDeliveryChargeIncludeTax(config('order.delivery_charge')),
            'total_delivery_charge_include_tax_rate' => config('order.total_delivery_charge_include_tax_rate') * 100,
            // 決済手数料
            'fee' => config('order.fee'),
            'fee_include_tax' => Order::feeIncludeTax(),
            'fee_include_tax_rate' => config('order.fee_include_tax_rate') * 100,
            // 計
            'total_num' => 0,
            'total_price' => 0,
            'coupon_discount_price' => 0,
            'coupon_id' => null,
            'coupon_name' => null,
            'coupon_code' => '',
            'is_delete_product_price' => false,
        ];
    }

    public function getCartData(
        array $productPriceData,
        ?string $couponCode
    ): array {
        if (count($productPriceData) === 0) {
            return [
                'cart' => $this->defaultCartInfo(),
                'cart_details' => [],
                'cart_in_product_prices' => [
                    'product_prices' => [],
                ],
            ];
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
            ->whereIn('id', collect($productPriceData)->pluck('id')->toArray())
            ->has('product')
            ->get()
            ->keyBy('id');
        if ($productPrices->count() === 0) {
            $cartData = $this->defaultCartInfo();
            $cartData['is_delete_product_price'] = true;
            return [
                'cart' => $cartData,
                'cart_details' => [],
                'cart_in_product_prices' => [
                    'product_prices' => [],
                ],
            ];
        }
        // 削除された商品があるかどうか。
        $isDeleteProductPrice = false;
        // 存在している商品のみ洗い出す
        $formatData = [];
        foreach ($productPriceData as $productPrice) {
            if (!isset($productPrices[$productPrice['id']])) {
                $isDeleteProductPrice = true;
                continue;
            }
            if ($productPrice['num'] === 0) {
                continue;
            }
            if (isset($formatData[$productPrice['id']])) {
                $formatData[$productPrice['id']]['num'] += $productPrice['num'];
                continue;
            }
            $formatData[$productPrice['id']]['num'] = $productPrice['num'];
            $formatData[$productPrice['id']]['id'] = $productPrice['id'];
        }
        $cartData['cart']['is_delete_product_price'] = $isDeleteProductPrice;

        foreach ($formatData as $key => $data) {
            if ($data['num'] <= 0) {
                unset($formatData[$key]);
            }
        }
        if (count($formatData) === 0) {
            return [
                'cart' => $this->defaultCartInfo(),
                'cart_details' => [],
                'cart_in_product_prices' => [
                    'product_prices' => [],
                ],
            ];
        }
        // カートデータ
        $cartData = $this->defaultCartInfo();
        // 商品
        foreach ($formatData as $data) {
            $cartData['total_num'] += $data['num'];
            $cartData['total_product_price'] += $productPrices[$data['id']]->price * $data['num'];
        }
        // クーポン
        $coupon = null;
        if (isset($couponCode)) {
            $coupon = $this->coupon->where('code', $couponCode)->first();
            if (!is_null($coupon) && Coupon::canUseCoupon($cartData['total_product_price'])) {
                $cartData['coupon_id'] = $coupon->id;
                $cartData['coupon_name'] = $coupon->name;
                $cartData['coupon_code'] = $coupon->code;
                $cartData['coupon_discount_price'] = $coupon->discount_price;
            }
        }
        // 送料
        $cartData['total_delivery_charge'] = Order::totalDeliveryCharge($cartData['total_product_price']);
        $cartData['total_delivery_charge_include_tax']
            = Order::totalDeliveryChargeIncludeTax($cartData['total_delivery_charge']);
        //  商品金額
        $cartData['total_product_include_tax'] = Order::productIncludeTax($cartData['total_product_price']);
        // 総合計
        $cartData['total_price'] = $cartData['total_product_price']
            + $cartData['total_delivery_charge']
            + $cartData['fee']
            - $cartData['coupon_discount_price'];
        // cart detail data
        $cartDetails = [];
        foreach ($formatData as $data) {
            $cartDetails[] = [
                'num' => $data['num'],
                'product_price_id' => $data['id'],
                'product_price' => $productPrices[$data['id']]->withoutRelations(),
                'product' => new TrialProductResource($productPrices[$data['id']]->product),
            ];
        }
        return [
            'cart' => $cartData,
            'cart_details' => $cartDetails,
            'cart_in_product_prices' => [
                'product_prices' => array_merge($formatData),
            ],
        ];
    }

    public function addCouponByUserIdIdAndCouponId(int $userId, int $couponId): void
    {
        $cartRow = $this->getCartByUserId($userId);
        $cartRow->update([
                'coupon_id' => $couponId,
            ]);
        $this->updateCartInfoByCartId($cartRow->id);
    }

    public function deleteCartByUserId(int $userId): void
    {
        $cartRow = $this->getCartByUserId($userId);
        $this->deleteCartDetailsByCartId($cartRow->id);
        $cartRow->is_delete = IsDelete::IS_DELETE;
        $cartRow->save();
        $cartRow->delete();
    }

    public function deleteCartDetailsByCartId(int $cartId): void
    {
        $cartDetailRows = $this->getCartDetailsByCartId($cartId);
        if ($cartDetailRows->count() === 0) {
            return;
        }
        foreach ($cartDetailRows as $cartDetailRow) {
            $cartDetailRow->delete();
        }
    }
}
