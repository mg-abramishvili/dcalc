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
                'id' => '65',
                'title' => 'Тестовый компонент',
                'price' => '100',
            ],
            [
                'id' => '81',
                'title' => 'Тестовый компонент 2',
                'price' => '150',
            ],
            [
                'id' => '99',
                'title' => 'Тестовый компонент 3',
                'price' => '250',
            ],
        ]);
    }
}
