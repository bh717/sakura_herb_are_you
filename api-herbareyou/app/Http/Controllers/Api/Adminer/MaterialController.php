<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\MaterialDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\MaterialStoreRequest;
use App\Http\Requests\Api\Adminer\MaterialUpdateRequest;
use App\Models\Material;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialController extends BaseController
{
    private $materialDomain;

    public function __construct(
        MaterialDomain $materialDomain
    ) {
        parent::__construct();
        $this->materialDomain = $materialDomain;
    }

    public function store(MaterialStoreRequest $request): JsonResponse
    {
        $material = DB::Transaction(function () use ($request) {
            return  $this->materialDomain->createMaterial($request->name, $request->category_no);
        });
        return $this->sendResponse($material);
    }

    public function index(Request $request): JsonResponse
    {
        return $this->sendResponse(
            $this->materialDomain->getAllMaterials()
        );
    }

    public function show(Request $request, Material $material): JsonResponse
    {
        return $this->sendResponse(
            $material
        );
    }

    public function update(MaterialUpdateRequest $request, Material $material): JsonResponse
    {
        $this->materialDomain->updateMaterial($material->id, $request->name, $request->category_no);
        return $this->sendResponse(
            $this->materialDomain->getMaterialById($material->id)
        );
    }

    public function destroy(Request $request, Material $material): JsonResponse
    {
        DB::Transaction(function () use ($material) {
            $this->materialDomain->deleteMaterialById($material->id);
            $this->materialDomain->updateSortOrder();
        });
        return $this->sendResponse(null, 204);
    }
}
