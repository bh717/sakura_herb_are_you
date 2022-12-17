<?php

namespace App\Http\Controllers\Api\User;

use App\Domains\UserDomain;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Adminer\UserCollection;
use App\Http\Resources\Adminer\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    private $userDomain;

    public function __construct(
        UserDomain $userDomain
    ) {
        parent::__construct();
        $this->userDomain = $userDomain;
    }

    public function index(): UserCollection
    {
        return new UserCollection(User::get());
    }

    public function show(Request $request, $user): UserResource
    {
        return new UserResource($user);
    }
}
