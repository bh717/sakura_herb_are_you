<?php

namespace App\Http\Middleware;

use App\Domains\AuthTokenDomain;
use App\Domains\UserDomain;
use Closure;

class UserAuthenticate
{
    private $authTokenDomain;
    private $userDomain;

    public function __construct(
        AuthTokenDomain $authTokenDomain,
        UserDomain $userDomain
    ) {
        $this->authTokenDomain = $authTokenDomain;
        $this->userDomain = $userDomain;
    }

    public function handle($request, Closure $next)
    {
        $h = getallheaders();
        if (!isset($h['Token'])) {
            $this->authTokenDomain->get403Response();
            exit();
        }
        $userId = $this->authTokenDomain->getClientIdByToken('user', $h['Token']);
        if (is_null($userId)) {
            $this->authTokenDomain->get403Response();
            exit();
        }
        $userRow = $this->userDomain->getUserById($userId);
        if (is_null($userRow)) {
            $this->authTokenDomain->get403Response();
            exit();
        }
        $request->user = $userRow;
        return $next($request);
    }
}
