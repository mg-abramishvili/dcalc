<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BoxTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('box_type')->insert([
            [
                'id' => '1',
                'box_id' => '1',
                'type_id' => '1',
            ],
            [
                'id' => '2',
                'box_id' => '2',
                'type_id' => '1',
            ],
        ]);
    }
}
