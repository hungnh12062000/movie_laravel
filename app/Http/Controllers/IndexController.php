<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\Movie_Genre;
use Illuminate\Support\Facades\DB;

// note



class IndexController extends Controller
{
    public function search(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];

            $category           = Category::orderBy('id', 'DESC')->where('status', 1)->get();
            $movie              = Movie::where('title', 'LIKE', '%'.$search.'%')->orderBy('update_day', 'DESC')->paginate(8); //get => all movie || paginate    => limited
            $movie_hot_sidebar  = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phimhot
            $movie_hot_trailer  = Movie::where('resolution', 5)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phim trailer

            $genre              = Genre::orderBy('id', 'DESC')->get();
            $country            = Country::orderBy('id', 'DESC')->get();
            return view('pages.search', compact('category', 'genre', 'country', 'search', 'movie', 'movie_hot_sidebar', 'movie_hot_trailer'));
        } else {
            return redirect()->to('/');
        }

    }
    // controll page pages/home
    public function home(){
        $movie_hot          = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('create_day', 'DESC')->get(); //phimhot slider
        $movie_hot_sidebar  = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phimhot
        $movie_hot_trailer  = Movie::where('resolution', 5)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phim trailer
        $category           = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre              = Genre::orderBy('id', 'DESC')->get();
        $country            = Country::orderBy('id', 'DESC')->get();
        $movie              = Movie::orderBy('update_day', 'DESC')->get(); //Sắp xếp theo update_day mới nhất
        $category_home      = Category::with('movie')->orderBy('id', 'DESC')->where('status', 1)->get();

        return view('pages.home', compact('category', 'genre', 'country', 'category_home', 'movie', 'movie_hot', 'movie_hot_sidebar', 'movie_hot_trailer'));
    }

    // controll page pages/category
    public function category($slug){
        $category           = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $cate_slug          = Category::where('slug', $slug)->first();
        $movie              = Movie::where('category_id', $cate_slug->id)->orderBy('update_day', 'DESC')->paginate(8); //get => all movie || paginate    => limited
        $movie_hot_sidebar  = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phimhot
        $movie_hot_trailer  = Movie::where('resolution', 5)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phim trailer

        $genre              = Genre::orderBy('id', 'DESC')->get();
        $country            = Country::orderBy('id', 'DESC')->get();
        return view('pages.category', compact('category', 'genre', 'country', 'cate_slug', 'movie', 'movie_hot_sidebar', 'movie_hot_trailer'));
    }

    //year
    public function year($year){
        $category           = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $year               = $year;
        $movie              = Movie::where('year', $year)->orderBy('update_day', 'DESC')->paginate(8); //get => all movie || paginate  => limited
        $movie_hot_sidebar  = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phimhot
        $movie_hot_trailer  = Movie::where('resolution', 5)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phim trailer

        $genre              = Genre::orderBy('id', 'DESC')->get();
        $country            = Country::orderBy('id', 'DESC')->get();
        return view('pages.year', compact('category', 'genre', 'country', 'year', 'movie', 'movie_hot_sidebar', 'movie_hot_trailer'));
    }

    //tag
    public function tag($tag){
        $category           = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $tag                = $tag;
        $movie              = Movie::where('tags','LIKE','%'.$tag.'%')->orderBy('update_day', 'DESC')->paginate(8); //get => all movie || paginate => limited
        $movie_hot_sidebar  = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phimhot
        $movie_hot_trailer  = Movie::where('resolution', 5)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phim trailer

        $genre              = Genre::orderBy('id', 'DESC')->get();
        $country            = Country::orderBy('id', 'DESC')->get();
        return view('pages.tag', compact('category', 'genre', 'country', 'tag', 'movie', 'movie_hot_sidebar', 'movie_hot_trailer'));
    }

    // controll page pages/genre
    public function genre($slug){
        $category           = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre_slug         = Genre::where('slug', $slug)->first();
        $genre              = Genre::orderBy('id', 'DESC')->get();
        $country            = Country::orderBy('id', 'DESC')->get();

        $movie_hot_sidebar  = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phimhot
        $movie_hot_trailer  = Movie::where('resolution', 5)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phim trailer
        //movie nhiều genre
        $movie_genre        = Movie_Genre::where('genre_id', $genre_slug->id)->get();
        $many_genre         = [];
        foreach ($movie_genre as $key => $movi) {
            $many_genre[]   = $movi->movie_id;
        }
        // return response()->json($many_genre);
        $movie              = Movie::whereIn('id', $many_genre)->orderBy('update_day', 'DESC')->paginate(8);
        return view('pages.genre', compact('category', 'genre', 'country', 'genre_slug', 'movie', 'movie_hot_sidebar', 'movie_hot_trailer'));
    }

    // controll page pages/country
    public function country($slug){
        $category           = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $country_slug       = Country::where('slug', $slug)->first();
        $movie              = Movie::where('country_id', $country_slug->id)->orderBy('update_day', 'DESC')->paginate(8);
        $movie_hot_sidebar  = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phimhot
        $movie_hot_trailer  = Movie::where('resolution', 5)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phim trailer

        $genre              = Genre::orderBy('id', 'DESC')->get();
        $country            = Country::orderBy('id', 'DESC')->get();
        return view('pages.country', compact('category', 'genre', 'country', 'country_slug', 'movie', 'movie_hot_sidebar', 'movie_hot_trailer'));
    }

    // go to page chi tiết phim
    public function movie($slug){
        $category           = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre              = Genre::orderBy('id', 'DESC')->get();
        $country            = Country::orderBy('id', 'DESC')->get();
        $movie              = Movie::with('category', 'country', 'genre', 'movie_genre')->where('slug', $slug)->where('status', 1)->first();
        $movie_hot_sidebar  = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phimhot
        $movie_hot_trailer  = Movie::where('resolution', 5)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get(); //sidebar phim trailer


        //Lấy những phim liên quan / cùng 'QUỐC GIA'. Trừ phim đang chọn
        // $movie_related  = Movie::with('category', 'country', 'genre')->where('country_id', $movie->country->id)->orderBy(DB::raw('RAND()'))->WhereNotIn('slug',[$slug])->get();

        //Lấy những phim liên quan / cùng 'THỂ LOẠI'. Trừ phim đang chọn
        // $movie_related  = Movie::with('category', 'country', 'genre')->where('genre_id', $movie->genre->id)->orderBy(DB::raw('RAND()'))->WhereNotIn('slug',[$slug])->get();

        //Lấy những phim liên quan / cùng 'DANH MỤC'. Trừ phim đang chọn
        $movie_related  = Movie::with('category', 'country', 'genre')->where('category_id', $movie->category->id)->orderBy(DB::raw('RAND()'))->WhereNotIn('slug',[$slug])->get();


        return view('pages.movie', compact('category', 'genre', 'country', 'movie', 'movie_related', 'movie_hot_sidebar', 'movie_hot_trailer'));
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
