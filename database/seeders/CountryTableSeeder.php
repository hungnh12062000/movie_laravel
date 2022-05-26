<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert(
            [
                'title' => 'Việt Nam',
                'description' => 'Phim VN hay nhất 2022',
                'status' => '1',
                'slug' => 'phim-viet-nam',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Ấn Độ',
                'description' => 'Phim Ấn Độ hay nhất 2022',
                'status' => '1',
                'slug' => 'phim-an-do',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Mỹ',
                'description' => 'Phim Mỹ hay nhất 2022',
                'status' => '1',
                'slug' => 'phim-my',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Hàn Quốc',
                'description' => 'Phim Hàn Quốc hay nhất 2022',
                'status' => '1',
                'slug' => 'phim-han-quoc',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Pháp',
                'description' => 'Phim Pháp hay nhất 2022',
                'status' => '1',
                'slug' => 'phim-phap',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Trung Quốc',
                'description' => 'Phim Trung Quốc hay nhất 2022',
                'status' => '1',
                'slug' => 'phim-trung-quoc',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Hồng Kông',
                'description' => 'Phim Hồng Kông hay nhất 2022',
                'status' => '1',
                'slug' => 'phim-hong-kong',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Nhật Bản',
                'description' => 'Phim Nhật Bản hay nhất 2022',
                'status' => '1',
                'slug' => 'phim-nhat-ban',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Thái Lan',
                'description' => 'Phim Thái Lan hay nhất 2022',
                'status' => '1',
                'slug' => 'phim-thai-lan',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Singapore',
                'description' => 'Phim Singapore hay nhất 2022',
                'status' => '1',
                'slug' => 'phim-singpapore',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title' => 'Đài Loan',
                'description' => 'Phim Đài Loan hay nhất 2022',
                'status' => '1',
                'slug' => 'phim-dai-loan',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],

        );

    }
}
