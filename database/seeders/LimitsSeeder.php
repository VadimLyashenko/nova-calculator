<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Limit;

class LimitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Limit::create([
            'limit' => NULL
        ]);

        Limit::create([
            'limit' => 20
        ]);

        Limit::create([
            'limit' => 30
        ]);

        Limit::create([
            'limit' => 31.5
        ]);

        Limit::create([
            'limit' => 35
        ]);

        Limit::create([
            'limit' => 50
        ]);
    }
}
