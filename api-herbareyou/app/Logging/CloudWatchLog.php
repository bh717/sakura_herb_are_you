<?php

namespace App\Logging;

use Aws\CloudWatchLogs\CloudWatchLogsClient;
use Maxbanton\Cwh\Handler\CloudWatch;
use Monolog\Logger;
use Rorecek\Ulid\Facades\Ulid;

class CloudWatchLog
{
    public function __invoke(array $config)
    {
        $handler = new CloudWatch(
            new CloudWatchLogsClient($config["sdk"]),
            $config['cloudwatch_group_name'],
            $config['cloudwatch_stream_prefix_name'] . Ulid::generate(),
            $config["retention"],
            10000,
            $config["tags"] ?? []
        );
        $logger = new Logger($config["name"] ?? 'cloudwatch');
        $logger->pushHandler($handler);
        return $logger;
    }
}
