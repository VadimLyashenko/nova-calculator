<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create([
            'area' => 1
        ]);

        Area::create([
            'area' => 2
        ]);

        Area::create([
            'area' => 3
        ]);

        Area::create([
            'area' => 4
        ]);

        Area::create([
            'area' => 5
        ]);

        Area::create([
            'area' => 6
        ]);

        Area::create([
            'area' => 7
        ]);

        Area::create([
            'area' => 8
        ]);
    }
}
