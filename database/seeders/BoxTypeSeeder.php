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
            ["id" => "6","box_id" => "1","type_id" => "1"],
            ["id" => "7","box_id" => "2","type_id" => "1"],
            ["id" => "8","box_id" => "3","type_id" => "1"],
            ["id" => "9","box_id" => "4","type_id" => "1"],
            ["id" => "10","box_id" => "5","type_id" => "1"],
            ["id" => "13","box_id" => "6","type_id" => "1"],
            ["id" => "12","box_id" => "7","type_id" => "1"]
        ]);
    }
}
