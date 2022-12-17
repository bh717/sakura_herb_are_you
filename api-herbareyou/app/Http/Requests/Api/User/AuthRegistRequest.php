<?php

namespace App\Http\Requests\Api\User;

use App\Enums\IsDelete;
use App\Http\Requests\Api\BaseApiRequest;
use App\Rules\AlphaNumCheck;
use App\Rules\ValidPhoneNumberFormat;
use Illuminate\Validation\Rule;

class AuthRegistRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [

            'first_name' => [
                'required',
                'max:255',
            ],
            'last_name' => [
                'required',
                'max:255',
            ],
            'first_name_kana' => [
                'required',
                'max:255',
                new AlphaNumCheck(),
            ],
            'last_name_kana' => [
                'required',
                'max:255',
                new AlphaNumCheck(),
            ],
            'email' => [
                'required',
                'max:255',
                'email',
                Rule::unique('users', 'email')->where('is_delete', IsDelete::IS_NOT_DELETE)->whereNull('deleted_at')
            ],
            'password' => [
                'required',
                'max:255',
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
                'max:255',
            ],
            'tel1' => [
                'required',
                new ValidPhoneNumberFormat(),
            ],
            'is_mail_magazine' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => __('validation_messages.required'),
            'first_name.max' => '255' . __('validation_messages.max'),
            'last_name.required' => __('validation_messages.required'),
            'last_name.max' => '255' . __('validation_messages.max'),
            'first_name_kana.required' => __('validation_messages.required'),
            'first_name_kana.max' => '255' . __('validation_messages.max'),
            'last_name_kana.required' => __('validation_messages.required'),
            'last_name_kana.max' => '255' . __('validation_messages.max'),
            'email.required' => __('validation_messages.required'),
            'email.max' => '255' . __('validation_messages.max'),
            'email.email' => '有効なメールアドレスを入力してください',
            'email.rule' => 'すでに使用されています',
            'password.required' => __('validation_messages.required'),
            'password.max' => '255' . __('validation_messages.max'),
            'password.CustomPassword' => '正しいパスワードで入力してください',
            'birthday.required' => __('validation_messages.required'),
            'birthday.date' => '日付形式で入力してください',
            'zip.required' => __('validation_messages.required'),
            'zip.max' => '10文字以内で入力してください',
            'address1.required' => __('validation_messages.required'),
            'address1.max' => '255' . __('validation_messages.max'),
            'tel1.required' => __('validation_messages.required'),
            'tel1.max' => '13文字以内で入力してください',
            'is_mail_magazine.required' => __('validation_messages.required'),
        ];
    }
}
