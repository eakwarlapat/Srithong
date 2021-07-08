<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rooms;
use App\Models\Customer;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rooms::all()->each(function (Rooms $rooms)
        {
            $customer = Customer::factory()->make();

            $rooms->customer()->save($customer);
        });
    }
}
