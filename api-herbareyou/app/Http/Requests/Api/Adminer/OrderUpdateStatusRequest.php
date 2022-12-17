<?php

namespace App\Http\Requests\Api\Adminer;

use App\Enums\OrderStatus;
use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Validation\Rule;

class OrderUpdateStatusRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'status' => [
                'required',
                Rule::in([
                    OrderStatus::WAITING_SEND, // 発送待ち
                    OrderStatus::SENT, // 発送済み
                    OrderStatus::COMPLETE, // 完了
                    OrderStatus::FAILED, // 購入失敗
                    OrderStatus::CANCEL, // キャンセル
                ]),
            ],

        ];
    }

    public function messages(): array
    {
        return [
            'in' => '正しいステータスを選んでください。'
        ];
    }
}
