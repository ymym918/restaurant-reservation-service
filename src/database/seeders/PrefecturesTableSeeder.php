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
            'name' => '東京都',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('prefectures')->insert($param);

        $param = [
            'name' => '大阪府',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('prefectures')->insert($param);

        $param = [
            'name' => '福岡県',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('prefectures')->insert($param);
    }
}
