<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert(
            [
                'title' => 'Việt Nam',
                'description' => 'Phim VN hay nhất 2022',
                'status' => '1',
                'slug' => 'phim-viet-nam',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],

        );

    }
}
