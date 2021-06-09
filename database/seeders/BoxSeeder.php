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
                'price' => 50000,
            ],
            [
                'id' => '2',
                'title' => 'ПроИнфо 21.5',
                'price' => 10000,
            ],
        ]);
    }
}
