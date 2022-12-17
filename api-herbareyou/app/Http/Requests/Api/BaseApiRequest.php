<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class BaseApiRequest extends FormRequest
{
    // public function authorize()
    // {
    //     return true;
    // }

    protected function failedValidation(Validator $validator): JsonResponse
    {
        $response = [
            // 'success' => false,
            'message' => __('messages.faild_validate'),
            // 'status' => 422,
            'data' => $validator->errors()->toArray(),
        ];
        throw new HttpResponseException(
            response()->json($response, 422)
        );
    }
}
