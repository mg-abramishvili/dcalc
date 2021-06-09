<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('types')->insert([
            [
                'id' => '1',
                'title' => 'Киоск',
            ],
        ]);
    }
}
