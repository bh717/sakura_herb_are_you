<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\ProductDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\ProductStoreRequest;
use App\Http\Requests\Api\Adminer\ProductUpdateRequest;
use App\Http\Resources\Adminer\ProductCollection;
use App\Http\Resources\Adminer\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends BaseController
{
    private $productDomain;

    public function __construct(
        ProductDomain $productDomain
    ) {
        parent::__construct();
        $this->productDomain = $productDomain;
    }

    public function store(ProductStoreRequest $request): ProductResource
    {
        $newProductRow = DB::Transaction(function () use ($request) {
            return  $this->productDomain->createProduct($request->validated());
        });
        $newProductRow->loadMissing(['category', 'keywords', 'materials', 'prices', 'symptoms', 'tastes', 'uploadFiles']);
        return new ProductResource($newProductRow);
    }

    public function index(Request $request): ProductCollection
    {
        $search = $request->input();
        $productRows = $this->productDomain->productPaginate($search);
        $productRows->loadMissing(['category', 'keywords', 'materials', 'prices', 'symptoms', 'tastes', 'uploadFiles']);
        return new ProductCollection($productRows);
    }

    public function show(Request $request, int $id)
    {
        $productRow = $this->productDomain->getProductById($id);
        if ($productRow === null) {
            return $this->send404ErrorResponse();
        }
        $productRow->loadMissing(['category', 'keywords', 'materials', 'prices', 'symptoms', 'tastes', 'uploadFiles']);
        return new ProductResource($productRow);
    }

    public function update(ProductUpdateRequest $request, Product $product): JsonResponse
    {
        DB::Transaction(function () use ($request, $product) {
            $this->productDomain->updateProductById($product->id, $request->validated());
        });
        $productRow = $this->productDomain->getProductById($product->id);
        $productRow->loadMissing(['category', 'keywords', 'materials', 'prices', 'symptoms', 'tastes', 'uploadFiles']);
        return $this->sendResponse($productRow);
    }

    public function destroy(Request $request, Product $product): JsonResponse
    {
        DB::Transaction(function () use ($product) {
            $this->productDomain->deleteProductById($product->id);
        });
        return $this->sendResponse(null, 204);
    }
}
