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
        $param = ['star' => '★★★★★'];
        DB::table('evaluations')->insert($param);

        $param = ['star' => '★★★★☆'];
        DB::table('evaluations')->insert($param);

        $param = ['star' => '★★★☆☆'];
        DB::table('evaluations')->insert($param);

        $param = ['star' => '★★☆☆☆'];
        DB::table('evaluations')->insert($param);

        $param = ['star' => '★☆☆☆☆'];
        DB::table('evaluations')->insert($param);
    }
}
