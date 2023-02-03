<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\TrialProductDomain;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\TrialProductStoreRequest;
use App\Http\Requests\Api\Adminer\TrialProductUpdateRequest;
use App\Http\Resources\Adminer\TrialProductCollection;
use App\Http\Resources\Adminer\TrialProductResource;
use App\Models\TrialProduct;
use App\Models\Product;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrialProductController extends BaseController
{
    private $trialproductDomain;

    public function __construct(
        TrialProductDomain $trialproductDomain
    ) {
        parent::__construct();
        $this->trialproductDomain = $trialproductDomain;
    }

    public function store(ProductStoreRequest $request): TrialProductResource
    {
        $newProductRow = DB::Transaction(function () use ($request) {
            return  $this->trialproductDomain->createProduct($request->validated());
        });
        $newProductRow->loadMissing(['category', 'keywords', 'materials', 'prices', 'symptoms', 'tastes', 'flavors', 'uploadFiles']);
        return new TrialProductResource($newProductRow);
    }

    public function index(Request $request): TrialProductCollection
    {
        $search = $request->input();
        $productRows = $this->trialproductDomain->productPaginate($search);
        $productRows->loadMissing(['category', 'keywords', 'materials', 'prices', 'symptoms', 'tastes', 'flavors', 'uploadFiles']);
        return new TrialProductCollection($productRows);
    }

    public function show(Request $request, int $id)
    {
        $productRow = $this->trialproductDomain->getProductById($id);
        if ($productRow === null) {
            return $this->send404ErrorResponse();
        }
        $productRow->loadMissing(['category', 'keywords', 'materials', 'prices', 'symptoms', 'tastes','flavors', 'uploadFiles']);
        return new TrialProductResource($productRow);
    }

    public function update(TrialProductUpdateRequest $request, TrialProduct $trialproduct): JsonResponse
    {
        // var_dump($product);
        // ob_start();
        // var_dump($trialproduct);
        // error_log(ob_get_clean(), 10);

        DB::Transaction(function () use ($request, $trialproduct) {
            $this->trialproductDomain->updateProductById($trialproduct->id, $request->validated());
        });
        $productRow = $this->trialproductDomain->getProductById($trialproduct->id);

        $productRow->loadMissing(['category', 'keywords', 'materials', 'prices', 'symptoms', 'tastes', 'flavors', 'uploadFiles']);
        return $this->sendResponse($productRow);
    }

    public function destroy(Request $request, TrialProduct $product): JsonResponse
    {
        DB::Transaction(function () use ($product) {
            $this->trialproductDomain->deleteProductById($product->id);
        });
        return $this->sendResponse(null, 204);
    }
}
