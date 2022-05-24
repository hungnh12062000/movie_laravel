<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public $timestamps = false;
    use HasFactory;

    // 1 tập chỉ thuộc 1 phim
    public function movie (){
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
