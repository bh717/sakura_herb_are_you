<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['daily'],
            'ignore_exceptions' => env('LOG_IGNORE_EXCEPTIONS', false),
        ],
        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
        ],
        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel/laravel.log'),
            'level' => 'debug',
            // 'days' => env('LOG_DAYS', 14),
            'permission' => 0777,
        ],
        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => 'critical',
        ],
        'papertrail' => [
            'driver' => 'monolog',
            'level' => 'debug',
            'handler' => SyslogUdpHandler::class,
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
        ],
        'stderr' => [
            'driver' => 'monolog',
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],
        'syslog' => [
            'driver' => 'syslog',
            'level' => 'debug',
        ],
        'errorlog' => [
            'driver' => 'errorlog',
            'level' => 'debug',
        ],
        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],
        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],
        'mail' => [
            'driver' => 'daily',
            'path' => storage_path('logs/mail/mail.log'),
            'level' => 'debug',
        ],
        'cloudwatch' => [
            'driver' => 'custom',
            'via' => App\Logging\CloudWatchLog::class,
            'sdk' => [
                'region' => env('AWS_DEFAULT_REGION', 'ap-northeast-1'),
                'version' => 'latest',
                'credentials' => [
                    'key' => env('AWS_ACCESS_KEY'),
                    'secret' => env('AWS_SECRET_KEY')
                ]
            ],
            'retention' => env('CLOUDWATCH_LOG_RETENTION', null), // <- ログ保存期間（null の場合は無制限）
            'cloudwatch_group_name' => env('AWS_CLOUDWATCH_LOG_GROUP_NAME', ''),
            'cloudwatch_stream_prefix_name' => env('AWS_CLOUDWATCH_LOG_STREAM_PREFIX_NAME', ''),
        ],
    ],
];
