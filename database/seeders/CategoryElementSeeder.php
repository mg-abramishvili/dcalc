<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryElementSeeder extends Seeder
{
    public function run()
    {
        DB::table('category_element')->insert([
            ["id" => "1","category_id" => "1","element_id" => "1"],
            ["id" => "2","category_id" => "1","element_id" => "2"],
            ["id" => "3","category_id" => "1","element_id" => "3"],
            ["id" => "6","category_id" => "2","element_id" => "4"],
            ["id" => "5","category_id" => "2","element_id" => "5"],
            ["id" => "7","category_id" => "2","element_id" => "6"],
            ["id" => "8","category_id" => "2","element_id" => "7"],
            ["id" => "9","category_id" => "3","element_id" => "8"],
            ["id" => "10","category_id" => "3","element_id" => "9"],
            ["id" => "11","category_id" => "3","element_id" => "10"],
            ["id" => "12","category_id" => "3","element_id" => "11"],
            ["id" => "18","category_id" => "5","element_id" => "17"],
            ["id" => "19","category_id" => "5","element_id" => "18"],
            ["id" => "15","category_id" => "5","element_id" => "14"],
            ["id" => "16","category_id" => "5","element_id" => "15"],
            ["id" => "20","category_id" => "6","element_id" => "19"],
            ["id" => "21","category_id" => "6","element_id" => "20"],
            ["id" => "22","category_id" => "7","element_id" => "21"],
            ["id" => "23","category_id" => "7","element_id" => "22"],
            ["id" => "24","category_id" => "7","element_id" => "23"]
        ]);
    }
}
