<?php

namespace App\Http\Controllers\Api\User;

use App\Domains\MaterialDomain;
use App\Domains\ProductDomain;
use App\Domains\SymptomDomain;
use App\Domains\TasteDomain;
use App\Enums\IsPublic;
use App\Models\SymptomProduct;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\User\ProductCollection;
use App\Http\Resources\User\ProductResource;
use Illuminate\Http\Request;

class SymptomProductController extends BaseController
{
    private $tasteDomain;
    private $materialDomain;
    private $productDomain;
    private $symptomDomain;

    public function __construct(
        TasteDomain $tasteDomain,
        MaterialDomain $materialDomain,
        ProductDomain $productDomain,
        SymptomDomain $symptomDomain
    )
    {
        parent::__construct();
        $this->tasteDomain = $tasteDomain;
        $this->materialDomain = $materialDomain;
        $this->productDomain = $productDomain;
        $this->symptomDomain = $symptomDomain;
    }

    public function index(Request $request): array
    {
        $model = new SymptomProduct;
        $data = $model->getIdFromProduct($request['id']);
        return $data;
    }

    public function show(Request $request, int $id): ProductResource
    {
        $productRow = $this->productDomain->getProductById($id);
        if (is_null($productRow) || $productRow->is_public !== IsPublic::IS_PUBLIC) {
            return $this->send404ErrorResponse();
        }
        $productRow->loadMissing(['category', 'keywords', 'materials', 'prices', 'symptoms', 'tastes', 'uploadFiles']);
        return new ProductResource($productRow);
    }

    public function product(Request $request)
    {
        $model = new SymptomProduct;
        $data = $model->getIdFromProduct($request['id']);
        // $data->loadMissing(['category', 'materials', 'prices', 'symptoms', 'tastes', 'uploadFiles']);

        // return new ProductResource($data);
        return $data;
    }
}