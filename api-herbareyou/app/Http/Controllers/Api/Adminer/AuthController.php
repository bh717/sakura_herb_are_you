<?php

namespace App\Http\Controllers\Api\Adminer;

use App\Domains\AdminerDomain;
use App\Domains\AuthTokenDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\User\AuthLoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    private $adminerDomain;
    private $authTokenDomain;
    private $validator;

    public function __construct(
        AdminerDomain $adminerDomain,
        AuthTokenDomain $authTokenDomain
    ) {
        parent::__construct();
        $this->adminerDomain = $adminerDomain;
        $this->authTokenDomain = $authTokenDomain;
    }

    public function login(AuthLoginRequest $request): JsonResponse
    {
        $adminer = $this->adminerDomain->getAdminerbyEmail($request->email);
        if (is_null($adminer) || !$this->adminerDomain->passwordVerify($request->password, $adminer->password)) {
            return $this->send401ErrorResponse(__('messages.faild_login'));
        }
        return $this->sendResponse(['access_token' => $adminer->createToken('authToken')->accessToken,]);
    }

    public function getMyData(Request $request): JsonResponse
    {
        return $this->sendResponse(auth()->user());
    }

    public function logined(Request $request): JsonResponse
    {
        $h = getallheaders();
        if (!isset($h['Token'])) {
            return $this->sendResponse(['is_login' => false]);
        }
        $adminerId = $this->authTokenDomain->getClientIdByToken('adminer', $h['Token']);
        if (is_null($adminerId)) {
            return $this->sendResponse(['is_login' => false]);
        }
        return $this->sendResponse(['is_login' => true]);
    }
}
