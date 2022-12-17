<?php

namespace App\Http\Controllers\Api\adminer;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\CouponStoreRequest;
use App\Http\Requests\Api\Adminer\CouponUpdateRequest;
use App\Http\Resources\Adminer\CouponCollection;
use App\Http\Resources\Adminer\CouponResource;
use App\Models\Coupon;
use Illuminate\Http\JsonResponse;

class CouponController extends BaseController
{
    private $coupon;

    public function __construct(
        Coupon $coupon
    ) {
        parent::__construct();
        $this->coupon = $coupon;
    }

    public function store(
        Coupon $coupon,
        CouponStoreRequest $request
    ): CouponResource {
        $coupon = new Coupon();
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->discount_price = $request->discount_price;
        $coupon->expired_at = $request->expired_at;
        $coupon->saveOrFail();
        return new CouponResource($coupon);
    }

    public function index(): CouponCollection
    {
        return new CouponCollection(
            $this->coupon->orderBy('expired_at', 'desc')->get()
        );
    }

    public function show(Coupon $coupon): CouponResource
    {
        return new CouponResource($coupon);
    }

    public function update(
        Coupon $coupon,
        CouponUpdateRequest $request
    ): CouponResource {
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->discount_price = $request->discount_price;
        $coupon->expired_at = $request->expired_at;
        $coupon->saveOrFail();
        return new CouponResource($coupon);
    }

    public function destroy(
        Coupon $coupon
    ): JsonResponse {
        $coupon->delete();
        $coupon->delete();
        return $this->sendResponse(null, 204);
    }
}
