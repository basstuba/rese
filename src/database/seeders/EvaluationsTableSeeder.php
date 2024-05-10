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
            'score' => 5,
            'star' => '&starf;&starf;&starf;&starf;&starf;'
        ];
        DB::table('evaluations')->insert($param);

        $param = [
            'score' => 4,
            'star' => '&starf;&starf;&starf;&starf;'
        ];
        DB::table('evaluations')->insert($param);

        $param = [
            'score' => 3,
            'star' => '&starf;&starf;&starf;'
        ];
        DB::table('evaluations')->insert($param);

        $param = [
            'score' => 2,
            'star' => '&starf;&starf;'
        ];
        DB::table('evaluations')->insert($param);

        $param = [
            'score' => 1,
            'star' => '&starf;'
        ];
        DB::table('evaluations')->insert($param);
    }
}
