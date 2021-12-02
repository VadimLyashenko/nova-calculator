<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ServiceTypesSeeder::class,
            LimitsSeeder::class,
            AreasSeeder::class,
            CountriesSeeder::class
        ]);
    }
}
