<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\AdminerStoreRequest;
use App\Services\AdminerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AdminerController extends BaseController
{
    private $validator;
    private $adminerService;

    public function __construct(
        AdminerService $adminerService
    ) {
        parent::__construct();
        $this->adminerService = $adminerService;
    }

    public function store(AdminerStoreRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $newAdminerRow = $this->adminerService->createAdminer($request->validated());
            DB::commit();
            return $this->sendResponse($newAdminerRow);
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error($th);
            return $this->send500ErrorResponse(__('messages.faild_regist'));
        }
    }
}
