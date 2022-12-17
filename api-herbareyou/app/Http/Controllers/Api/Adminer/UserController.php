<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\UserDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Adminer\UserMailMagazineRequest;
use App\Http\Requests\Api\Adminer\UserUpdateRequest;
use App\Mail\User\UserMailMagazine;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class UserController extends BaseController
{
    private $userDomain;

    public function __construct(
        UserDomain $userDomain
    ) {
        parent::__construct();
        $this->userDomain = $userDomain;
    }

    public function index(Request $request): JsonResponse
    {
        $userList = $this->userDomain->userPaginate($request->input());
        return $this->sendResponse($userList);
    }

    public function show(Request $request, int $id)
    {
        $userRow = $this->userDomain->getUserById($id);
        if (!$userRow) {
            return $this->send404ErrorResponse();
        }
        return $this->sendResponse($userRow);
    }

    public function update(UserUpdateRequest $request, int $id): JsonResponse
    {
        if (!$this->userDomain->existsUser($id)) {
            return $this->send404ErrorResponse();
        }
        $inputData = $request->validated();
        DB::beginTransaction();
        try {
            if (!$this->userDomain->canUseEmailOfUpdate($id, $inputData['email'])) {
                DB::rollBack();
                return $this->send500ErrorResponse(__('messages.faild_update'));
            }
            $isSuccess = $this->userDomain->updateUserById($id, $inputData);
            if (!$isSuccess) {
                DB::rollBack();
                return $this->send500ErrorResponse(__('messages.faild_update'));
            }
            $userRow = $this->userDomain->getUserById($id);
            DB::commit();
            return $this->sendResponse($userRow, __('messages.success_update'));
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error($th);
            return $this->send500ErrorResponse(__('messages.faild_update'));
        }
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        if (!$this->userDomain->existsUser($id)) {
            return $this->send404ErrorResponse();
        }
        DB::beginTransaction();
        try {
            $isSuccess = $this->userDomain->deleteUserById($id);
            if (!$isSuccess) {
                DB::rollBack();
                return $this->send500ErrorResponse(__('messages.faild_delete'));
            }
            DB::commit();
            return $this->sendResponseMessage(__('messages.success_delete'));
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error($th);
            return $this->send500ErrorResponse(__('messages.faild_delete'));
        }
    }

    public function mailMagazine(UserMailMagazineRequest $request): JsonResponse
    {
        $users = User::whereMailMagazine()->get();
        if ($users->isEmpty()) {
            return $this->sendResponseMessage(__('messages.success'));
        }
        foreach ($users as $user) {
            Mail::to($user)->send(new UserMailMagazine($user, $request->subject, $request->body));
        }
        return $this->sendResponseMessage(__('messages.success'));
    }
}
