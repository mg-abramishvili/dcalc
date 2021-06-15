<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                "id" => "1",
                "title" => "Монитор",
                "slug" => "monitor",
                "created_at" => "2021-06-11 08:45:35",
                "updated_at" => "2021-06-11 08:45:35"
            ],
            [
                "id" => "2",
                "title" => "Сенсорный экран",
                "slug" => "touchpanel",
                "created_at" => "2021-06-11 08:47:13",
                "updated_at" => "2021-06-11 08:47:13"
            ],
            [
                "id" => "3",
                "title" => "Покраска корпуса",
                "slug" => "boxpaint",
                "created_at" => "2021-06-11 08:51:07",
                "updated_at" => "2021-06-11 08:51:07"
            ],
            [
                "id" => "6",
                "title" => "RAM память",
                "slug" => "ram",
                "created_at" => "2021-06-11 13:14:55",
                "updated_at" => "2021-06-11 13:14:55"
            ],
            [
                "id" => "5",
                "title" => "Процессор",
                "slug" => "cpu",
                "created_at" => "2021-06-11 08:54:57",
                "updated_at" => "2021-06-11 08:54:57"
            ],
            [
                "id" => "7",
                "title" => "Жесткий диск",
                "slug" => "disk",
                "created_at" => "2021-06-11 13:18:11",
                "updated_at" => "2021-06-11 13:18:11"
            ]
        ]);
    }
}
