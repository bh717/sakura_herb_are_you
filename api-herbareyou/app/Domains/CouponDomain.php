<?php

namespace App\Domains;

use App\Models\Coupon;
use App\Models\ProductPrice;

class CouponDomain extends BaseDomain
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

    public function createCoupon(
        array $data
    ): ?Coupon {
        return $this->coupon->create($data);
    }

    public function getAllCoupons(int $id): ?Coupon
    {
        return $this->coupon->get($id);
    }

    public function getCouponById(int $id): ?Coupon
    {
        return $this->coupon->find($id);
    }

    public function getCouponByCouponCode(string $couponCode): ?Coupon
    {
        return $this->coupon->where('code', $couponCode)->first();
    }

    public function updateCouponById(int $id, array $data): bool
    {
        return $this->getCouponById($id)->update($data);
    }
}
