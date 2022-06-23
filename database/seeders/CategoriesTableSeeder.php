<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                'title' => 'Phim lẻ',
                'description' => 'Phim lẻ hay nhất 2022',
                'status' => '1',
                'slug' => 'phim-le',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Phim bộ',
                'description' => 'Phim bộ hay nhất 2022',
                'status' => '1',
                'slug' => 'phim-bộ',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Phim chiếu rạp',
                'description' => 'Phim chiếu rạp hay nhất 2022',
                'status' => '1',
                'slug' => 'phim-chieu-rap',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]
        );
    }
}
