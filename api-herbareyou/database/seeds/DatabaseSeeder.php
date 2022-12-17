<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // if(app()->environment('prod')) {
        //     $this->call([
        //     ]);
        // } else {
        //     $this->call([
        //         InitSqlSeeder::class,
        //     ]);
        // }
        $this->call([
            InitSqlSeeder::class,
        ]);
    }
}
