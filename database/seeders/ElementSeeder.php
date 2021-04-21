<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ElementSeeder extends Seeder
{
    public function run()
    {
        DB::table('elements')->insert([
            [
                'id' => '1',
                'title' => 'Корпус №1',
                'price' => 100,
            ],
            [
                'id' => '2',
                'title' => 'iiyama 27" model-1',
                'price' => 150,
            ],
            [
                'id' => '3',
                'title' => 'Samsung 55" abcd',
                'price' => 250,
            ],
        ]);
    }
}
