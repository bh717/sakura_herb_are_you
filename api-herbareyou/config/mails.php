<?php

$appName = '【' . config('consts.APP_NAME') . '】';

return[

    'adminer' => [
        'inquiry_store' => [
            'subject' => "{$appName}お問い合わせがありました",
            'from' => env('MAIL_FROM_ADDRESS', ''),
            // 'from_name' => 'shop',
            'to' => '',
            'to_name' => '',
            'body' => 'Mails.Adminer.inquiry_store_to_adminer',
        ],

    ],
    'user' => [
        'auth_regist' => [
            'subject' =>  "{$appName}ユーザー登録が完了しました",
            'from' => env('MAIL_FROM_ADDRESS', ''),
            // 'from_name' => 'shop',
            'to' => '',
            'to_name' => '',
            'body' => 'Mails.User.auth_regist_to_user',
        ],
        'auth_reset_password' => [
            'subject' => "{$appName} パスワード変更のご案内",
            'from' => env('MAIL_FROM_ADDRESS', ''),
            // 'from_name' => 'shop',
            'to' => '',
            'to_name' => '',
            'body' => 'Mails.User.auth_reset_password_to_user',
        ],
        'inquiry_store' => [
            'subject' => "{$appName}お問い合わせありがとうございます",
            'from' => env('MAIL_FROM_ADDRESS', ''),
            // 'from_name' => 'shop',
            'to' => '',
            'to_name' => '',
            'body' => 'Mails.User.inquiry_store_to_user',
        ],
        'order_store' => [
            'subject' => "{$appName}ご注文をありがとうございます",
            'from' => env('MAIL_FROM_ADDRESS', ''),
            // 'from_name' => 'shop',
            'to' => '',
            'to_name' => '',
            'body' => 'Mails.User.order_store_to_user',
        ],
        'mail_magazine' => [
            // 'subject' => 'お問い合わせがありました',
            'from' => env('MAIL_FROM_ADDRESS', ''),
            // 'from_name' => 'shop',
            'to' => '',
            'to_name' => '',
            'body' => 'Mails.User.mail_magazine',
        ],
        'sent_product' => [
            'subject' => "{$appName}商品を発送いたしました",
            'from' => env('MAIL_FROM_ADDRESS', ''),
            // 'from_name' => 'shop',
            'to' => '',
            'to_name' => '',
            'body' => 'Mails.User.sent_product',
        ],
        'order_after_mail' => [
            'subject' => "{$appName}商品はいかがでしたか？",
            'from' => env('MAIL_FROM_ADDRESS', ''),
            // 'from_name' => 'shop',
            'to' => '',
            'to_name' => '',
            'body' => 'Mails.User.order_after_mail',
        ],
    ],
];
