<?php

namespace App\Providers;

use App\Aws\S3Handler;
use Illuminate\Support\ServiceProvider;

class AwsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('s3', S3Handler::class);
    }

    public function boot()
    {
    }
}
