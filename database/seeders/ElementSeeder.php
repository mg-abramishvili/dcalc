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
            ["id" => "1","title" => "19 дюймов","pre_rub" => "0.00","pre_usd" => "60.00","price" => "4350.00","created_at" => "2021-06-11 08:46:17","updated_at" => "2021-06-11 08:46:17"],
            ["id" => "2","title" => "21,5 дюйма","pre_rub" => "0.00","pre_usd" => "135.00","price" => "9750.00","created_at" => "2021-06-11 08:46:40","updated_at" => "2021-06-11 08:46:40"],
            ["id" => "3","title" => "32 дюйма","pre_rub" => "0.00","pre_usd" => "160.00","price" => "11600.00","created_at" => "2021-06-11 08:47:00","updated_at" => "2021-06-11 08:47:00"],
            ["id" => "4","title" => "PCAP 19","pre_rub" => "0.00","pre_usd" => "90.00","price" => "6500.00","created_at" => "2021-06-11 08:48:11","updated_at" => "2021-06-11 08:48:59"],
            ["id" => "5","title" => "PCAP 21.5","pre_rub" => "0.00","pre_usd" => "95.00","price" => "6900.00","created_at" => "2021-06-11 08:48:43","updated_at" => "2021-06-11 08:48:43"],
            ["id" => "6","title" => "PCAP 32","pre_rub" => "0.00","pre_usd" => "200.00","price" => "14450.00","created_at" => "2021-06-11 08:50:13","updated_at" => "2021-06-11 08:50:13"],
            ["id" => "7","title" => "ИК рамка 32","pre_rub" => "0.00","pre_usd" => "110.00","price" => "7950.00","created_at" => "2021-06-11 08:50:48","updated_at" => "2021-06-11 08:50:48"],
            ["id" => "8","title" => "Порошковая по каталогу RAL","pre_rub" => "4000.00","pre_usd" => "0.00","price" => "4000.00","created_at" => "2021-06-11 08:51:56","updated_at" => "2021-06-11 08:51:56"],
            ["id" => "9","title" => "Порошковая по каталогу RAL","pre_rub" => "0.00","pre_usd" => "0.00","price" => "0.00","created_at" => "2021-06-11 08:52:36","updated_at" => "2021-06-11 08:52:36"],
            ["id" => "10","title" => "RAL 7035 серый","pre_rub" => "0.00","pre_usd" => "0.00","price" => "0.00","created_at" => "2021-06-11 08:52:58","updated_at" => "2021-06-11 08:52:58"],
            ["id" => "11","title" => "Автоэмаль","pre_rub" => "35000.00","pre_usd" => "0.00","price" => "35000.00","created_at" => "2021-06-11 08:53:36","updated_at" => "2021-06-11 08:53:36"],
            ["id" => "17","title" => "Intel Celeron G5900","pre_rub" => "0.00","pre_usd" => "188.00","price" => "13600.00","created_at" => "2021-06-11 09:00:13","updated_at" => "2021-06-11 09:00:13"],
            ["id" => "14","title" => "Встроенный Intel Celeron J4005","pre_rub" => "0.00","pre_usd" => "90.00","price" => "6500.00","created_at" => "2021-06-11 08:55:45","updated_at" => "2021-06-11 08:55:45"],
            ["id" => "15","title" => "нет ПК","pre_rub" => "0.00","pre_usd" => "0.00","price" => "0.00","created_at" => "2021-06-11 08:56:07","updated_at" => "2021-06-11 08:56:07"],
            ["id" => "18","title" => "Intel Core i3","pre_rub" => "0.00","pre_usd" => "145.00","price" => "10500.00","created_at" => "2021-06-11 09:02:16","updated_at" => "2021-06-11 09:02:16"],
            ["id" => "19","title" => "4 Gb","pre_rub" => "0.00","pre_usd" => "35.00","price" => "2550.00","created_at" => "2021-06-11 13:16:30","updated_at" => "2021-06-11 13:16:30"],
            ["id" => "20","title" => "8 Gb","pre_rub" => "0.00","pre_usd" => "70.00","price" => "5100.00","created_at" => "2021-06-11 13:16:55","updated_at" => "2021-06-11 13:16:55"],
            ["id" => "21","title" => "SSD 120 Gb","pre_rub" => "200.00","pre_usd" => "30.00","price" => "2400.00","created_at" => "2021-06-11 13:21:17","updated_at" => "2021-06-11 13:21:17"],
            ["id" => "22","title" => "SSD 256 Gb","pre_rub" => "200.00","pre_usd" => "45.00","price" => "3450.00","created_at" => "2021-06-11 13:23:05","updated_at" => "2021-06-11 13:23:05"],
            ["id" => "23","title" => "HDD 500 Gb","pre_rub" => "200.00","pre_usd" => "40.00","price" => "3100.00","created_at" => "2021-06-11 13:25:00","updated_at" => "2021-06-11 13:25:00"]
        ]);
    }
}
