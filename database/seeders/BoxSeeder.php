<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BoxSeeder extends Seeder
{
    public function run()
    {
        DB::table('boxes')->insert([
            [
                'id' => '1',
                'title' => 'ПроИнфо 19',
                'pre_rub' => 5000,
                'pre_usd' => 500,
                'price' => 41450,
            ],
            [
                'id' => '2',
                'title' => 'ПроИнфо 21.5',
                'pre_rub' => 8000,
                'pre_usd' => 800,
                'price' => 66300,
            ],
        ]);
    }
}
