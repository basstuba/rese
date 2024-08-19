<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Assessment;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AreasTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(NumbersTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(TimesTableSeeder::class);
        $this->call(EvaluationsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(ManagersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        User::factory(20)->create();
        Reservation::factory(200)->create();
        Review::factory(200)->create();
        Assessment::factory(200)->create();
    }
}
