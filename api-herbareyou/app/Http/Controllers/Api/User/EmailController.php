<?php

namespace App\Http\Controllers\Api\User;

use App\Domains\MaterialDomain;
use App\Domains\ProductDomain;
use App\Domains\SymptomDomain;
use App\Domains\TasteDomain;
use App\Enums\IsPublic;
use App\Models\DetailedSymptom;
use App\Models\Email;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\User\ProductCollection;
use App\Http\Resources\User\ProductResource;
use Illuminate\Http\Request;

class EmailController extends BaseController
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
    ) {
        parent::__construct();
        $this->tasteDomain = $tasteDomain;
        $this->materialDomain = $materialDomain;
        $this->productDomain = $productDomain;
        $this->symptomDomain = $symptomDomain;
    }

    public function index(Request $request): ProductCollection
    {
        $model = new Email;
        $data = $model->getNamefromEmail($request['email']);
        return $this->sendResponse($data);
    }
    public function getName(Request $request)
    {
        $model = new Email;
        $data = $model->getNamefromEmail($request['email']);
        return $this->sendResponse($data);
    }
}
