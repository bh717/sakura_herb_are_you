<?php

namespace App\Http\Requests\Api\Adminer;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends BaseApiRequest
{
    public function rules(): array
    {
        $id = $this->route('user');
        return [
            'first_name' => [
                'required',
                'max:200',
            ],
            'last_name' => [
                'required',
                'max:200',
            ],
            'first_name_kana' => [
                'required',
                'max:200',
            ],
            'last_name_kana' => [
                'required',
                'max:200',
            ],
            'email' => [
                'required',
                'max:200',
                'email',
                Rule::unique('users', 'email')->whereNull('deleted_at')->whereNot('id', $id),
            ],
            'password' => [
                'nullable',
                'max:200',
                'CustomPassword',
            ],
            'birthday' => [
                'required',
                'date',
            ],
            'zip' => [
                'required',
                'max:10',
            ],
            'address1' => [
                'required',
                'max:200',
            ],
            'tel1' => [
                'required',
                'max:13',
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
