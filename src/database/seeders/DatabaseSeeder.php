<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PrefecturesTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(RestaurantsTableSeeder::class);
        $this->call(UsersTableSeeder::class);

    }
}
