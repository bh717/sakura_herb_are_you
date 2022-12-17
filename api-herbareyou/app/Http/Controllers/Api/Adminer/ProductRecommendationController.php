<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\ProductDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\ProductRecommendationIndexRequest;
use App\Http\Requests\Api\Adminer\ProductRecommendationStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductRecommendationController extends BaseController
{
    private $productDomain;

    public function __construct(
        ProductDomain $productDomain
    ) {
        parent::__construct();
        $this->productDomain = $productDomain;
    }

    public function store(ProductRecommendationStoreRequest $request): JsonResponse
    {
        DB::Transaction(function () use ($request) {
            $this->productDomain->createRecommendation($request->product_ids, $request->kind);
        });
        return $this->sendResponse(null, 204);
    }

    public function index(ProductRecommendationIndexRequest $request): JsonResponse
    {
        return $this->sendResponse(
            $this->productDomain->getAllProductRecommendations($request->kind)
        );
    }
}
