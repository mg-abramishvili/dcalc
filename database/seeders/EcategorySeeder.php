<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EcategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('ecategories')->insert([
            [
                'id' => '1',
                'title' => 'Корпус',
            ],
            [
                'id' => '2',
                'title' => 'Монитор',
            ],
        ]);
    }
}
