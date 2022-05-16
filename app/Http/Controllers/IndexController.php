<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;

// note



class IndexController extends Controller
{
    // controll page pages/home
    public function home(){
        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre    = Genre::orderBy('id', 'DESC')->get();
        $country  = Country::orderBy('id', 'DESC')->get();
        $movie    = Movie::orderBy('id', 'DESC')->get();

        $category_home = Category::with('movie')->orderBy('id', 'DESC')->where('status', 1)->get();

        return view('pages.home', compact('category', 'genre', 'country', 'category_home', 'movie'));
    }

    // controll page pages/category
    public function category($slug){
        $category   = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $cate_slug  = Category::where('slug', $slug)->first();
        $movie      = Movie::where('category_id', $cate_slug->id)->paginate(8); //get => all movie || paginate => limited

        $genre      = Genre::orderBy('id', 'DESC')->get();
        $country    = Country::orderBy('id', 'DESC')->get();
        return view('pages.category', compact('category', 'genre', 'country', 'cate_slug', 'movie'));
    }

    // controll page pages/genre
    public function genre($slug){
        $category   = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre_slug = Genre::where('slug', $slug)->first();
        $movie      = Movie::where('genre_id', $genre_slug->id)->paginate(8);

        $genre      = Genre::orderBy('id', 'DESC')->get();
        $country    = Country::orderBy('id', 'DESC')->get();
        return view('pages.genre', compact('category', 'genre', 'country', 'genre_slug', 'movie'));
    }

    // controll page pages/country
    public function country($slug){
        $category       = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $country_slug   = Country::where('slug', $slug)->first();
        $movie          = Movie::where('country_id', $country_slug->id)->paginate(8);

        $genre          = Genre::orderBy('id', 'DESC')->get();
        $country        = Country::orderBy('id', 'DESC')->get();
        return view('pages.country', compact('category', 'genre', 'country', 'country_slug', 'movie'));
    }

    // go to page chi tiết phim
    public function movie($slug){
        $category       = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre          = Genre::orderBy('id', 'DESC')->get();
        $country        = Country::orderBy('id', 'DESC')->get();
        $movie          = Movie::with('category', 'country', 'genre')->where('slug', $slug)->where('status', 1)->first();

        //Lấy những phim liên quan / cùng 'QUỐC GIA'. Trừ phim đang chọn
        // $movie_related  = Movie::with('category', 'country', 'genre')->where('country_id', $movie->country->id)->orderBy(DB::raw('RAND()'))->WhereNotIn('slug',[$slug])->get();

        //Lấy những phim liên quan / cùng 'THỂ LOẠI'. Trừ phim đang chọn
        // $movie_related  = Movie::with('category', 'country', 'genre')->where('genre_id', $movie->genre->id)->orderBy(DB::raw('RAND()'))->WhereNotIn('slug',[$slug])->get();

        //Lấy những phim liên quan / cùng 'DANH MỤC'. Trừ phim đang chọn
        $movie_related  = Movie::with('category', 'country', 'genre')->where('category_id', $movie->category->id)->orderBy(DB::raw('RAND()'))->WhereNotIn('slug',[$slug])->get();


        return view('pages.movie', compact('category', 'genre', 'country', 'movie', 'movie_related'));
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
