<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rooms;
use Illuminate\Support\Facades\DB;


class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
            ['room_number' => 101, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 102, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 103, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 104, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 105, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 106, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 107, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 108, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 201, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 202, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 203, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 204, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 205, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 206, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 207, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 208, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 301, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 302, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 303, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 304, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 305, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 306, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 307, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 308, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 401, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 402, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 403, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 404, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 405, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 406, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 407, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 408, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 501, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 502, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 503, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 504, 'room_status' => 1, 'room_type' => 1, 'price' => 3000, 'internet' => random_int(1, 2)],
            ['room_number' => 505, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 506, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 507, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
            ['room_number' => 508, 'room_status' => 1, 'room_type' => 2, 'price' => 3500, 'internet' => random_int(1, 2)],
        ];

        foreach($rooms as $room){
            Rooms::create($room);
        }

    }
}
