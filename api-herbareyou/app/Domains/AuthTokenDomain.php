<?php

namespace App\Domains;

use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;

class AuthTokenDomain extends BaseDomain
{
    public function __construct()
    {
    }

    public function getToken(): string
    {
        return bin2hex(random_bytes(64));
    }

    public function setTokenToRedis(
        string $type,
        int $clientId,
        string $token,
        string $expiresAt
    ): bool {
        $key = $type === config('consts.auth_adminer_str')
            ? config('consts.auth_adminer_redis_prefix') . '_' . $token
            : config('consts.auth_user_redis_prefix') . '_' . $token;
        $result = Redis::setnx($key, $clientId);
        if ($result !== 1) {
            return false;
        }
        Redis::expire($key, $this->getExpiresSeconds($expiresAt));
        return true;
    }

    public function getClientIdByToken(string $type, string $token): ?int
    {
        $key = $type === 'adminer'
            ? config('consts.auth_adminer_redis_prefix') . '_' . $token
            : config('consts.auth_user_redis_prefix') . '_' . $token;
        return Redis::get($key);
    }

    public function get403Response(): void
    {
        $response = [
            'success' => false,
            'message' => 'Not Access Deny',
            'status' => 403,
        ];
        header('Access-Control-Allow-Origin: *');
        header('status: 403');
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getExpiresAt(): string
    {
        return Carbon::now()->addSeconds(config('consts.AUTH_EXPIRES'))->format('Y-m-d H:i:s');
    }

    private function getExpiresSeconds(string $dateTime): int
    {
        return strtotime($dateTime) - time();
    }
}
