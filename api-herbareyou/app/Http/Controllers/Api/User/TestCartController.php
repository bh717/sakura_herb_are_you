<?php

namespace App\Http\Controllers\Api\User;

use App\Domains\TestCartDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\User\CartMineRequest;
use Illuminate\Http\JsonResponse;

class TestCartController extends BaseController
{
    private $testcartDomain;

    public function __construct(
        TestCartDomain $testcartDomain
    ) {
        parent::__construct();
        $this->testcartDomain = $testcartDomain;
    }

    public function mine(
        CartMineRequest $request
    ): JsonResponse {
        return $this->sendResponse(
            $this->testcartDomain->getCartData($request->product_prices, $request->coupon_code)
        );
    }
}
