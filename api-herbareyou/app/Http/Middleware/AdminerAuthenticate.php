<?php

namespace App\Http\Middleware;

use App\Domains\AdminerDomain;
use App\Domains\AuthTokenDomain;
use Closure;

class AdminerAuthenticate
{
    private $adminerDomain;
    private $authTokenDomain;

    public function __construct(
        AdminerDomain $adminerDomain,
        AuthTokenDomain $authTokenDomain
    ) {
        $this->adminerDomain = $adminerDomain;
        $this->authTokenDomain = $authTokenDomain;
    }

    public function handle($request, Closure $next)
    {
        $h = getallheaders();
        if (!isset($h['Token'])) {
            $this->authTokenDomain->get403Response();
            exit();
        }
        $adminerId = $this->authTokenDomain->getClientIdByToken('adminer', $h['Token']);
        if (is_null($adminerId)) {
            $this->authTokenDomain->get403Response();
            exit();
        }
        $adminerRow = $this->adminerDomain->getAdminerbyId($adminerId);
        if (is_null($adminerRow)) {
            $this->authTokenDomain->get403Response();
            exit();
        }
        $request->adminer = $adminerRow;
        return $next($request);
    }
}
