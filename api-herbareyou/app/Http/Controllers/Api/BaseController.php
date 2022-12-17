<?php

namespace App\Http\Controllers\Api;

// header('Access-Control-Allow-Origin: *');
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

// *-*-*-*-*-*-*-*-*-*-ステータスコード一覧-*-*-*-*-*-*-*-*-*-*
// 200    OK    一般的な正常終了
// 201    Created    新規作成のみで使用。正常終了
// 400    Bad Request    リクエストが不正    期限切れなどもこのエラー
// 401    Unauthorized    認証エラー
// 404    Not Found    リソースが存在しないエラー
// 409    Conflict    作成しようとしたリソースが既にある
// 499    error    ほか、各種エラー    細かい情報はエラー詳細情報として記載する？
// 422  Validate Error バリデーションエラー (ステータスについては参照→https://qiita.com/nesheep5/items/6da796f6ac628c430c36)
// 500    Internal  Server Error    サーバー関連のエラー
// 503    Service  Unavailable    何らかのサービスエラー

class BaseController extends Controller
{
    public function __construct()
    {
    }

    protected function sendResponse($data = null, int $status = 200): JsonResponse
    {
        return response()->json(
            $data,
            $status,
            [],
            \JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );
    }

    protected function sendMessageResponse(string $message, int $status = 200): JsonResponse
    {
        $response = [
            'message' => $message,
        ];
        return $this->sendResponse($response, $status);
    }

    protected function sendResponseMessage(string $message = '', int $status = 200): JsonResponse
    {
        $response = [
            'data'    => [],
            'message' => $message,
        ];
        return response()->json(
            $response,
            $status,
            [],
            \JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );
    }

    protected function sendErrorResponse($data = [], string $message = '', int $status = 499): JsonResponse
    {
        $response = [
            'message' => $message,
        ];
        if (!empty($data)) {
            $response['data'] = $data;
        }
        return response()->json(
            $response,
            $status,
            [],
            \JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );
    }

    protected function sendMessageErrorResponse(string $message, int $status = 400): JsonResponse
    {
        $response = [
            'message' => $message,
        ];
        return $this->sendResponse($response, $status);
    }

    protected function sendExceptionErrorResponse($e): JsonResponse
    {
        $message = $e->getMessage();
        $status = $e->getCode();
        $data = method_exists($e, 'getData') ? $e->getData() : [];
        return $this->sendErrorResponse($data, $message, $status);
    }

    protected function send400ErrorResponse(array $validate = [], string $message = '', int $status = 400): JsonResponse
    {
        if (empty($message)) {
            $message = __('messages.faild_validate');
        }
        return $this->sendErrorResponse($validate, $message, $status);
    }

    protected function send422ErrorResponse(array $validate = [], string $message = '', int $status = 422): JsonResponse
    {
        if (empty($message)) {
            $message = __('messages.faild_validate');
        }
        return $this->sendErrorResponse($validate, $message, $status);
    }

    protected function send404ErrorResponse(string $message = '', int $status = 404): JsonResponse
    {
        if (empty($message)) {
            $message = __('messages.not_found');
        }
        return $this->sendErrorResponse([], $message, $status);
    }

    protected function send403ErrorResponse(string $message = '', int $status = 403): JsonResponse
    {
        $message = $message === '' ? 'Not Access Deny' : $message;
        return $this->sendErrorResponse([], $message, $status);
    }

    protected function send499ErrorResponse(string $message = '', int $status = 499): JsonResponse
    {
        return $this->sendErrorResponse([], $message, $status);
    }

    protected function send401ErrorResponse(string $message = '', int $status = 401): JsonResponse
    {
        if (empty($message)) {
            $message = __('messages.unauthenticated');
        }
        return $this->sendErrorResponse([], $message, $status);
    }

    protected function send500ErrorResponse(string $message = '', int $status = 500): JsonResponse
    {
        $message = $message === '' ? 'fatal error' : $message;
        return $this->sendErrorResponse([], $message, $status);
    }
}
