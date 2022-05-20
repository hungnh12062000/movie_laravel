<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public $timestamps = false;
    use HasFactory;

    // 1 thể loại chỉ có 1 phim
    public function movie (){
        return $this->belongsTo(Movie::class, 'genre_id');
    }
}
