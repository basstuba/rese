<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'star' => '★★★★★',
            'count' => 5
        ];
        DB::table('evaluations')->insert($param);

        $param = [
            'star' => '★★★★☆',
            'count' => 4
        ];
        DB::table('evaluations')->insert($param);

        $param = [
            'star' => '★★★☆☆',
            'count' => 3
        ];
        DB::table('evaluations')->insert($param);

        $param = [
            'star' => '★★☆☆☆',
            'count' => 2
        ];
        DB::table('evaluations')->insert($param);

        $param = [
            'star' => '★☆☆☆☆',
            'count' => 1
        ];
        DB::table('evaluations')->insert($param);
    }
}
