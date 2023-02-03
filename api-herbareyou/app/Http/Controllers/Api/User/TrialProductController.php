<?php

namespace App\Http\Controllers\Api\User;

use App\Domains\MaterialDomain;
use App\Domains\TrialProductDomain;
use App\Domains\SymptomDomain;
use App\Domains\TasteDomain;
use App\Domains\FlavorDomain;

use App\Models\TrialProductKind;
use App\Models\TrialProductSubItem;




use App\Enums\IsPublic;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\User\TrialProductCollection;
use App\Http\Resources\User\TrialProductResource;
use Illuminate\Http\Request;

class TrialProductController extends BaseController
{
    private $tasteDomain;
    private $materialDomain;
    private $productDomain;
    private $symptomDomain;

    private $flavorDomain;

    public function __construct(
        TasteDomain $tasteDomain,
        MaterialDomain $materialDomain,
        TrialProductDomain $productDomain,
        SymptomDomain $symptomDomain,
        FlavorDomain $flavorDomain
    ) {
        parent::__construct();
        $this->tasteDomain = $tasteDomain;
        $this->materialDomain = $materialDomain;
        $this->productDomain = $productDomain;
        $this->symptomDomain = $symptomDomain;
        $this->flavorDomain = $flavorDomain;
    }

    public function index(Request $request): TrialProductCollection
    {
        $search = $request->input();
        $search['is_public'] = IsPublic::IS_PUBLIC;
        // dd($search);
        $products = $this->productDomain->productPaginate($search);
        $products->loadMissing(['category', 'keywords', 'materials', 'prices', 'symptoms', 'tastes', 'flavors','uploadFiles']);
        return new TrialProductCollection($products);
    }

    public function show(Request $request, int $id): TrialProductResource
    {
        $productRow = $this->productDomain->getProductById($id);
        if (is_null($productRow) || $productRow->is_public !== IsPublic::IS_PUBLIC) {
            return $this->send404ErrorResponse();
        }
        $productRow->loadMissing(['category', 'keywords', 'materials', 'prices', 'symptoms', 'tastes', 'flavors', 'uploadFiles']);
        return new TrialProductResource($productRow);
    }

    public function categories(Request $request)
    {
        $data = [
            'tastes' => $this->tasteDomain->getAllTastes(),
            'flavors' => $this->flavorDomain->getAllFlavors(),
            'materials' => $this->materialDomain->getAllMaterials(),
            'symptoms' => $this->symptomDomain->getAllSymptoms(),
        ];
        return $this->sendResponse($data);
    }

    public function getKind (Request $request){
        $model = new TrialProductKind;
        $data = $model->getKindFromId($request['id']);
        return $this->sendResponse($data);
    }

    public function getSubItem (Request $request){
        $model = new TrialProductSubItem;
        $data = $model->getSubItemFromId($request['id']);
        return $this->sendResponse($data);
    }
}
