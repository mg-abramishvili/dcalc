<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EcategoryElementSeeder extends Seeder
{
    public function run()
    {
        DB::table('ecategory_element')->insert([
            [
                'id' => '1',
                'element_id' => '1',
                'ecategory_id' => '1',
            ],
            [
                'id' => '2',
                'element_id' => '2',
                'ecategory_id' => '2',
            ],
            [
                'id' => '3',
                'element_id' => '3',
                'ecategory_id' => '2',
            ],
        ]);
    }
}
