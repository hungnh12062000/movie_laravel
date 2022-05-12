<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Movie;

class IndexController extends Controller
{
    // controll page pages/home
    public function home(){
        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre    = Genre::orderBy('id', 'DESC')->get();
        $country  = Country::orderBy('id', 'DESC')->get();
        return view('pages.home', compact('category', 'genre', 'country'));
    }

    // controll page pages/category
    public function category($slug){
        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $cate_slug= Category::where('slug', $slug)->first();
        $genre    = Genre::orderBy('id', 'DESC')->get();
        $country  = Country::orderBy('id', 'DESC')->get();
        return view('pages.category', compact('category', 'genre', 'country', 'cate_slug'));
    }

    // controll page pages/genre
    public function genre($slug){
        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre_slug= Genre::where('slug', $slug)->first();
        $genre    = Genre::orderBy('id', 'DESC')->get();
        $country  = Country::orderBy('id', 'DESC')->get();
        return view('pages.genre', compact('category', 'genre', 'country', 'genre_slug'));
    }

    // controll page pages/country
    public function country($slug){
        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $country_slug= Country::where('slug', $slug)->first();
        $genre    = Genre::orderBy('id', 'DESC')->get();
        $country  = Country::orderBy('id', 'DESC')->get();
        return view('pages.country', compact('category', 'genre', 'country', 'country_slug'));
    }

    // go to page chi tiết phim
    public function movie(){
        return view('pages.movie');
    }

    // go to page xem phim
    public function watch(){
        return view('pages.watch');
    }

    // go to page tập phim
    public function episode(){
        return view('pages.episode');
    }

}
