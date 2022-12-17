<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\TherapistDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\TherapistStoreRequest;
use App\Http\Requests\Api\Adminer\TherapistUpdateRequest;
use App\Models\Therapist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TherapistController extends BaseController
{
    private $therapistDomain;

    public function __construct(
        TherapistDomain $therapistDomain
    ) {
        parent::__construct();
        $this->therapistDomain = $therapistDomain;
    }

    public function store(TherapistStoreRequest $request): JsonResponse
    {
        $therapists = $this->therapistDomain->createTherapist($request->validated());
        $therapists->loadMissing(['blogs',]);
        return $this->sendResponse($therapists);
    }

    public function index(Request $request): JsonResponse
    {
        $allPublicBlogs = $this->therapistDomain->getAllTherapists();
        $allPublicBlogs->loadMissing(['blogs',]);
        return $this->sendResponse($allPublicBlogs);
    }

    public function show(Request $request, Therapist $therapist): JsonResponse
    {
        $therapist->loadMissing(['blogs',]);
        return $this->sendResponse($therapist);
    }

    public function update(TherapistUpdateRequest $request, Therapist $therapist): JsonResponse
    {
        $this->therapistDomain->updateTherapistById($therapist->id, $request->validated());
        $therapist = $this->therapistDomain->getTherapistById($therapist->id);
        $therapist->loadMissing(['blogs',]);
        return $this->sendResponse($therapist);
    }

    public function destroy(Request $request, Therapist $therapist): JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->therapistDomain->deleteTherapistById($therapist->id);
            DB::commit();
            return $this->sendResponse(null, 204);
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error($th);
            return $this->send500ErrorResponse();
        }
    }
}
