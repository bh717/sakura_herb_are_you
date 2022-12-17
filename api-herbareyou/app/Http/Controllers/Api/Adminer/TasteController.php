<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\TasteDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\TasteStoreRequest;
use App\Http\Requests\Api\Adminer\TasteUpdateRequest;
use App\Models\Taste;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasteController extends BaseController
{
    private $tasteDomain;

    public function __construct(
        TasteDomain $tasteDomain
    ) {
        parent::__construct();
        $this->tasteDomain = $tasteDomain;
    }

    public function store(TasteStoreRequest $request): JsonResponse
    {
        $taste = DB::Transaction(function () use ($request) {
            return  $this->tasteDomain->createTaste($request->name, $request->category_no);
        });
        return $this->sendResponse($taste);
    }

    public function index(Request $request): JsonResponse
    {
        return $this->sendResponse(
            $this->tasteDomain->getAllTastes()
        );
    }

    public function show(Request $request, Taste $taste): JsonResponse
    {
        return $this->sendResponse(
            $taste
        );
    }

    public function update(TasteUpdateRequest $request, Taste $taste): JsonResponse
    {
        $this->tasteDomain->updateTaste($taste->id, $request->name, $request->category_no);
        return $this->sendResponse(
            $this->tasteDomain->getTasteById($taste->id)
        );
    }

    public function destroy(Request $request, Taste $taste): JsonResponse
    {
        DB::Transaction(function () use ($taste) {
            $this->tasteDomain->deleteTasteById($taste->id);
            $this->tasteDomain->updateSortOrder();
        });
        return $this->sendResponse(null, 204);
    }
}
