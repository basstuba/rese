<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '管理者',
            'email' => 'admin@admin.com',
            'email_verified_at' => '2024-05-15 10:30:00',
            'password' => Hash::make('administrator'),
            'remember_token' => ''
        ];
        DB::table('admins')->insert($param);
    }
}
