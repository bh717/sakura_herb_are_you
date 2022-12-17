<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\ProductDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\ProductCategoryStoreRequest;
use App\Http\Requests\Api\Adminer\ProductCategoryUpdateRequest;
use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends BaseController
{
    private $productDomain;

    public function __construct(
        ProductDomain $productDomain
    ) {
        parent::__construct();
        $this->productDomain = $productDomain;
    }

    public function store(ProductCategoryStoreRequest $request): JsonResponse
    {
        $category = DB::Transaction(function () use ($request) {
            return  $this->productDomain->createCategory($request->name, $request->series_name);
        });
        return $this->sendResponse($category);
    }

    public function index(Request $request): JsonResponse
    {
        return $this->sendResponse(
            $this->productDomain->getAllCategorys()
        );
    }

    public function show(Request $request, ProductCategory $category): JsonResponse
    {
        return $this->sendResponse(
            $category
        );
    }

    public function update(ProductCategoryUpdateRequest $request, ProductCategory $category): JsonResponse
    {
        $this->productDomain->updateCategory($category->id, $request->name, $request->series_name);
        return $this->sendResponse(
            $this->productDomain->getCategoryById($category->id)
        );
    }

    public function destroy(Request $request, ProductCategory $category): JsonResponse
    {
        DB::Transaction(function () use ($category) {
            $this->productDomain->deleteCategoryById($category->id);
            $this->productDomain->updateSortOrder();
        });
        return $this->sendResponse(null, 204);
    }
}
