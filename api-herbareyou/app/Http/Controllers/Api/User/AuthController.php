<?php

namespace App\Http\Controllers\Api\User;

use App\Domains\AuthTokenDomain;
use App\Domains\UserDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\User\AuthLoginRequest;
use App\Http\Requests\Api\User\AuthRegistRequest;
use App\Http\Requests\Api\User\AuthResetPasswordRequest;
use App\Http\Requests\Api\User\AuthResetPasswordUrlRequest;
use App\Http\Requests\Api\User\AuthUpdateRequest;
use App\Mail\User\AuthRegistToUser;
use App\Mail\User\AuthResetPasswordToUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class AuthController extends BaseController
{
    private $authTokenDomain;
    private $userDomain;

    public function __construct(
        AuthTokenDomain $authTokenDomain,
        UserDomain $userDomain
    ) {
        parent::__construct();
        $this->authTokenDomain = $authTokenDomain;
        $this->userDomain = $userDomain;
    }

    public function login(AuthLoginRequest $request): JsonResponse
    {
        $user = $this->userDomain->getUserByEmail($request->email);
        if (is_null($user) || !$this->userDomain->passwordVerify($request->password, $user->password)) {
            return $this->send401ErrorResponse(__('messages.faild_login'));
        }
        return $this->sendResponse(['access_token' => $user->createToken('authToken')->accessToken,]);
    }

    public function getMyData(Request $request): JsonResponse
    {
        return $this->sendResponse(auth()->user());
    }

    public function regist(AuthRegistRequest $request): JsonResponse
    {
        $inputData = $request->validated();
        DB::beginTransaction();
        try {
            if (!$this->userDomain->canUseEmailOfCreate($inputData['email'])) {
                DB::rollBack();
                return $this->send500ErrorResponse(__('messages.faild_update'));
            }
            $newUser = $this->userDomain->createUser($inputData);
            $this->userDomain->createDeliveryLocationByUser($newUser);
            Mail::to($newUser)->send(new AuthRegistToUser($newUser));
            DB::commit();
            return $this->sendResponse($newUser);
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error($th);
            return $this->send500ErrorResponse(__('messages.faild_regist'));
        }
    }

    public function update(AuthUpdateRequest $request): JsonResponse
    {
        $user = auth()->user();
        $inputData = $request->validated();
        DB::beginTransaction();
        try {
            if (!$this->userDomain->canUseEmailOfUpdate($user->id, $inputData['email'])) {
                DB::rollBack();
                return $this->send500ErrorResponse(__('messages.faild_update'));
            }
            $isSuccess = $this->userDomain->updateUserById($user->id, $inputData);
            if (!$isSuccess) {
                DB::rollBack();
                return $this->send500ErrorResponse(__('messages.faild_update'));
            }
            $user = $this->userDomain->getUserById($user->id);
            DB::commit();
            return $this->sendResponse($user);
        } catch (\Throwable $th) {
            DB::rollBack();
            \Log::error($th);
            return $this->send500ErrorResponse(__('messages.faild_update'));
        }
    }

    public function resetPasswordUrl(AuthResetPasswordUrlRequest $request): JsonResponse
    {
        $user = $this->userDomain->getUserByEmail($request->email);
        if (is_null($user)) {
            return $this->sendResponse(null, 204);
        }
        $resetPasswordRow = DB::Transaction(function () use ($user) {
            return $this->userDomain->createResetPassword($user->id);
        });
        Mail::to($user)->send(new AuthResetPasswordToUser($user, $resetPasswordRow));
        return $this->sendResponse(null, 204);
    }

    public function resetPassword(AuthResetPasswordRequest $request): JsonResponse
    {
        $userResetPasswordRow = $this->userDomain->getResetPasswordByCode($request->code);
        if ($userResetPasswordRow->expired_at->isPast()) {
            return $this->sendMessageErrorResponse('有効期限切れのurlです');
        }
        DB::Transaction(function () use ($request, $userResetPasswordRow) {
            $this->userDomain->updatePasswordById($userResetPasswordRow->user_id, $request->password);
            $this->userDomain->deleteResetPasswordsByUserId($userResetPasswordRow->user_id);
        });
        return $this->sendResponse(null, 204);
    }
}
