<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('APP_ENV') === 'local') {
            \DB::listen(function ($query) {
                $sql_log = [
                'time' => sprintf('%.2f ms', $query->time),
                'sql' => $query->sql,
                'bindings' => $query->bindings,
                ];
                $queryLogName = storage_path('logs/query/query-' . date('Y-m-d') . '.log');
                if (!file_exists($queryLogName)) {
                    $this->createQueryLogFile($queryLogName);
                }
                $queryLog = fopen($queryLogName, 'a+');
                fwrite($queryLog, date('[Y-m-d H:i:s] ') . json_encode($sql_log) . PHP_EOL);
                fclose($queryLog);
            });
        }
    }

    private function createQueryLogFile(string $queryLogName): void
    {
        touch($queryLogName);
        chmod($queryLogName, 0777);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
