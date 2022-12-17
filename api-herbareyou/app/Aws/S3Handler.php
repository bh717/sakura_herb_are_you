<?php

namespace App\Aws;

use Aws\Result;
use Aws\S3\S3Client;

class S3Handler
{
    public const SIGN_VALIDITY_TIME = '+5 minutes';

    public function getS3Client(): S3Client
    {
        return  new S3Client([
            'version' => config('aws.version'),
            'region'  => config('aws.s3_region'),
            'credentials' => [
                'key' => config('aws.access_key'),
                'secret' => config('aws.secret_key'),
            ],
        ]);
    }

    public function createPresignedUrl(string $bucket, string $key): string
    {
        $s3Client = $this->getS3Client();
        $command = $s3Client->getCommand('PutObject', [
            'Bucket' => $bucket,
            'Key' => $key,
        ]);
        $request = $s3Client->createPresignedRequest($command, self::SIGN_VALIDITY_TIME);
        return (string)$request->getUri();
    }

    public function getObject(string $bucket, string $key): Result
    {
        return $this->getS3Client()->getObject([
            'Bucket' => $bucket,
            'Key' => $key,
        ]);
    }
}
