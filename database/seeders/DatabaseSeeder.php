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
        // \App\Models\User::factory(10)->create();

        //call category
        $this->call([
            CategoriesTableSeeder::class
        ]);

        //call country
        $this->call([
            CountryTableSeeder::class
        ]);

        //call genre
        $this->call([
            GenreTableSeeder::class
        ]);
    }
}
