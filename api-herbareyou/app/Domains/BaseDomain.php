<?php

namespace App\Domains;

abstract class BaseDomain
{
    public function __construct()
    {
        // parent::__construct ();
    }

    // curlの設定
    protected function curl(bool $setAccessTokenFlg = true)
    {
        $curl = new Curl();
        $curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
        $curl->setOpt(CURLOPT_MAXREDIRS, 3);
        $curl->setHeader("Accept", "application/json");
        if ($setAccessTokenFlg) {
            $curl = $this->setHeaderAccessToken($curl);
        }
        return $curl;
    }

    private function setHeaderAccessToken(Curl $curl): Curl
    {
        $accessToken = $this->getAccessToken();
        $curl->setHeader("token", $accessToken);
        return $curl;
    }

    // curlでの返り値の整形
    protected function resultApi(Curl $curl): object
    {
        $c = $curl->http_status_code;
        if ($c == 404 || $c == 403 || $c == 405 || $c == 499 || $c == 401 || $c == 500) {
            $response = json_decode($curl->response, true);
            $message = !empty($response['message']) ? $response['message'] : '';
            return (object) ['success' => false, 'status' => $c, 'message' => $message];
        }
        $response = json_decode($curl->response, true);
        return (object) ['success' => $response['success'], 'data' => $response['data'], 'message' => $response['message'], 'status' => $c];
    }

    private function getAccessToken(): string
    {
        $h = getallheaders();
        if (isset($h['Token'])) {
            return $h['Token'];
        }
        return '';
    }

    protected function getPerPage(array $search = []): int
    {
        if (empty($search['per_page'])) {
            $perPage =  config('consts.per_page');
        } elseif (preg_match('/^[0-9]+$/', $search['per_page'])) {
            $perPage = $search['per_page'];
        } elseif ($search['per_page'] == '-1') {
            $perPage = -1;
        } else {
            $perPage =  config('consts.per_page');
        }
        return $perPage;
    }

    protected function getGenRandomStr(int $length = 8): string
    {
        return bin2hex(random_bytes($length));
    }
}
