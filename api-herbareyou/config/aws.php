<?php

return [
    'access_key' => env('AWS_ACCESS_KEY'),
    'secret_key' => env('AWS_SECRET_KEY'),
    'version' => 'latest',
    's3_region' => env('AWS_S3_REGION', 'ap-northeast-1'),
    's3_default_bucket' => env('S3_DEFAULT_BUCKET'),
    's3_path' => env('AWS_S3_PATH'),
    's3_uploads_path' => env('AWS_S3_PATH') . 'uploads/',
    'cloudfront_domain' => env('AWS_CLOUDFRONT_DOMAIN'),
    'default_region' => env('AWS_DEFAULT_REGION'),
];
