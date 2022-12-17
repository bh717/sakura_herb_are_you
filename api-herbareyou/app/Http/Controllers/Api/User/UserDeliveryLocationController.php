<?php

namespace App\Http\Controllers\Api\User;

use App\Domains\UserDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\User\UserDeliveryLocationUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserDeliveryLocationController extends BaseController
{
    private $userDomain;

    public function __construct(
        UserDomain $userDomain
    ) {
        parent::__construct();
        $this->userDomain = $userDomain;
    }

    public function update(UserDeliveryLocationUpdateRequest $request): JsonResponse
    {
        $userId = auth()->user()->id;
        $delivelyLocation = $this->userDomain->updateOrCreateDeliveryLocationByUserId($userId, $request->validated());
        return $this->sendResponse($delivelyLocation);
    }

    public function show(Request $request): JsonResponse
    {
        $userId = auth()->user()->id;
        $delivelyLocation = $this->userDomain->getDeliveryLocationByUserId($userId);
        // if (is_null($delivelyLocation)) {
        //     return $this->send404ErrorResponse();
        // }
        return $this->sendResponse($delivelyLocation);
    }
}
