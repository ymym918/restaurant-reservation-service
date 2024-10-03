<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrefecturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '東京',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('prefectures')->insert($param);

        $param = [
            'name' => '大阪',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('prefectures')->insert($param);

        $param = [
            'name' => '福岡',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('prefectures')->insert($param);
    }
}
