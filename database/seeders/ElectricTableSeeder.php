<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Electric;

class ElectricTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meter = [
            'electricmeter' => 20
        ];

        Electric::create($meter);
    }
}
