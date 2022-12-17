<?php

return [
    'per_page' => 100,
    'auth_adminer_redis_prefix' => 'adminerToken',
    'auth_user_redis_prefix' => 'userToken',

    'auth_adminer_str' => 'adminer',
    'auth_user_str' => 'user',

    'APP_NAME' => env('APP_NAME'),

    'APP_DEBUG' => env('APP_DEBUG', false),
    'AUTH_EXPIRES' => env('AUTH_EXPIRES', ''),
    'BASE_APP_URL' => env('BASE_APP_URL', ''),
    'ADMINER_EMAIL' => env('ADMINER_EMAIL', null),

    'no_image_url' => env('NO_IMAGE_URL'),

    'AFTER_MAIL_SUB_DAYS' => (int) env('AFTER_MAIL_SUB_DAYS', 7), # アフターメール
    'POPULARATION_PERIOD_DAYS' => (int) env('POPULARATION_PERIOD_DAYS', 7), // 集計期間
];
