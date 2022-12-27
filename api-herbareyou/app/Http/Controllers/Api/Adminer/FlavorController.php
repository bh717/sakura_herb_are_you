<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\FlavorDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\FlavorStoreRequest;
use App\Http\Requests\Api\Adminer\FlavorUpdateRequest;
use App\Models\Flavor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlavorController extends BaseController
{
    private $flavorDomain;

    public function __construct(
        FlavorDomain $flavorDomain
    ) {
        parent::__construct();
        $this->flavorDomain = $flavorDomain;
    }

    public function store(FlavorStoreRequest $request): JsonResponse
    {
        $flavor = DB::Transaction(function () use ($request) {
            return  $this->flavorDomain->createFlavor($request->name, $request->category_no);
        });
        return $this->sendResponse($flavor);
    }

    public function index(Request $request): JsonResponse
    {
        return $this->sendResponse(
            $this->flavorDomain->getAllFlavors()
        );
    }

    public function show(Request $request, Flavor $flavor): JsonResponse
    {
        return $this->sendResponse(
            $flavor
        );
    }

    public function update(FlavorUpdateRequest $request, Flavor $flavor): JsonResponse
    {
        $this->flavorDomain->updateFlavor($flavor->id, $request->name, $request->category_no);
        return $this->sendResponse(
            $this->flavorDomain->getFlavorById($flavor->id)
        );
    }

    public function destroy(Request $request, Flavor $flavor): JsonResponse
    {
        DB::Transaction(function () use ($flavor) {
            $this->flavorDomain->deleteFlavorById($flavor->id);
            $this->flavorDomain->updateSortOrder();
        });
        return $this->sendResponse(null, 204);
    }
}
