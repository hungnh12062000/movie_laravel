<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $timestamps = false;
    use HasFactory;

    //1 phim có 1 danh mục - 1 quốc gia - 1 thể loại
    public function category (){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function country (){
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function genre (){
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    //1 phim có nhiều thể loại
    public function movie_genre (){
        return $this->belongsToMany(Genre::class, 'movie_genre', 'movie_id', 'genre_id'); //table name and two columns
    }

    //1 phim có nhiều tập
    public function episode (){
        return $this->hasMany(Episode::class);
    }


}
