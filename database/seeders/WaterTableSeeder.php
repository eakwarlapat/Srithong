<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Water;

class WaterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meter = [
            'watermeter' => 7
        ];

        Water::create($meter);
    }
}
