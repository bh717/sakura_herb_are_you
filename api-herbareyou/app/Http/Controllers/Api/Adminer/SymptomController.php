<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\SymptomDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\SymptomStoreRequest;
use App\Http\Requests\Api\Adminer\SymptomUpdateRequest;
use App\Models\Symptom;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SymptomController extends BaseController
{
    private $symptomDomain;

    public function __construct(
        SymptomDomain $symptomDomain
    ) {
        parent::__construct();
        $this->symptomDomain = $symptomDomain;
    }

    public function store(SymptomStoreRequest $request): JsonResponse
    {
        $symptom = DB::Transaction(function () use ($request) {
            return  $this->symptomDomain->createSymptom($request->name, $request->category_no);
        });
        return $this->sendResponse($symptom);
    }

    public function index(Request $request): JsonResponse
    {
        return $this->sendResponse(
            $this->symptomDomain->getAllSymptoms()
        );
    }

    public function show(Request $request, Symptom $symptom): JsonResponse
    {
        return $this->sendResponse(
            $symptom
        );
    }

    public function update(SymptomUpdateRequest $request, Symptom $symptom): JsonResponse
    {
        $this->symptomDomain->updateSymptom($symptom->id, $request->name, $request->category_no);
        return $this->sendResponse(
            $this->symptomDomain->getSymptomById($symptom->id)
        );
    }

    public function destroy(Request $request, Symptom $symptom): JsonResponse
    {
        DB::Transaction(function () use ($symptom) {
            $this->symptomDomain->deleteSymptomById($symptom->id);
            $this->symptomDomain->updateSortOrder();
        });
        return $this->sendResponse(null, 204);
    }
}
