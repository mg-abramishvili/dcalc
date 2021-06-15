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
                'pre_rub' => 17500,
                'pre_usd' => 0,
                'price' => 17500,
            ],
            [
                'id' => '2',
                'title' => 'ПроИнфо 21.5',
                'pre_rub' => 19500,
                'pre_usd' => 0,
                'price' => 19500,
            ],
            [
                'id' => '3',
                'title' => 'Элиот 19',
                'pre_rub' => 6500,
                'pre_usd' => 0,
                'price' => 6500,
            ],
            [
                'id' => '4',
                'title' => 'Элиот 21,5',
                'pre_rub' => 7500,
                'pre_usd' => 0,
                'price' => 7500,
            ],
            [
                'id' => '5',
                'title' => 'Элиот 32',
                'pre_rub' => 9500,
                'pre_usd' => 0,
                'price' => 9500,
            ],
            [
                'id' => '6',
                'title' => 'Лэндис 21.5',
                'pre_rub' => 24000,
                'pre_usd' => 0,
                'price' => 24000,
            ],
            [
                'id' => '7',
                'title' => 'Лэндис 32',
                'pre_rub' => 26000,
                'pre_usd' => 0,
                'price' => 26000,
            ],
        ]);
    }
}
