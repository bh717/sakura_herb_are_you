<?php

namespace App\Http\Controllers\Api\User;

use App\Domains\CouponDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\User\EffectivenessCouponRequest;
use Illuminate\Http\JsonResponse;

class CouponController extends BaseController
{
    private $couponDomain;

    public function __construct(
        CouponDomain $couponDomain
    ) {
        parent::__construct();
        $this->contentDomain = $couponDomain;
    }

    public function effectiveness(
        EffectivenessCouponRequest $request
    ): JsonResponse {
        return $this->sendResponse([
            'effectiveness' => true,
        ]);
    }
}
