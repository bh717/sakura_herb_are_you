<?php

namespace App\Http\Controllers\Api\User;

use App\Domains\CartDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\User\CartMineRequest;
use Illuminate\Http\JsonResponse;

class CartController extends BaseController
{
    private $cartDomain;

    public function __construct(
        CartDomain $cartDomain
    ) {
        parent::__construct();
        $this->cartDomain = $cartDomain;
    }

    public function mine(
        CartMineRequest $request
    ): JsonResponse {
        return $this->sendResponse(
            $this->cartDomain->getCartData($request->product_prices, $request->coupon_code)
        );
    }
}
