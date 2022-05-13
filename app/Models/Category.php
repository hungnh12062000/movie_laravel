<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Mặc định, các Model trong Laravel sẽ có các trường timestamps là created_at và updated_at
    // Khi create/update dữ liệu thông qua Model, Laravel sẽ tự động insert/update timestamps.
    // Đối với những DB table không có các field timestamps có thể disable chúng để tránh lỗi.

    public $timestamps = false;
    use HasFactory;

    //One to Many: 1 category sẽ có nhiều movie
    public function movie(){
        return $this->hasMany(Movie::class)->orderBy('id', 'DESC');
    }
}
