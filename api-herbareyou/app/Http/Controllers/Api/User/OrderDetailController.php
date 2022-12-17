<?php

namespace App\Http\Controllers\Api\User;

use App\Domains\CartDomain;
use App\Domains\OrderDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\User\OrderDetailCollection;
use Illuminate\Http\Request;

class OrderDetailController extends BaseController
{
    private $cartDomain;
    private $orderDomain;

    public function __construct(
        CartDomain $cartDomain,
        OrderDomain $orderDomain
    ) {
        parent::__construct();
        $this->cartDomain = $cartDomain;
        $this->orderDomain = $orderDomain;
    }

    public function index(Request $request): OrderDetailCollection
    {
        $userId = auth()->user()->id;
        $orderDetailRows = $this->orderDomain->getOrderDetailsByUserId($userId);
        $orderDetailRows->load([
            'order',
            'product.category',
            'product.keywords',
            'product.materials',
            'product.prices',
            'product.symptoms',
            'product.tastes',
            'product.uploadFiles',
        ]);
        return new OrderDetailCollection($orderDetailRows);
    }
}
