<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = ['search_area' => '東京都'];
        DB::table('areas')->insert($param);

        $param = ['search_area' => '大阪府'];
        DB::table('areas')->insert($param);

        $param = ['search_area' => '福岡県'];
        DB::table('areas')->insert($param);
    }
}
