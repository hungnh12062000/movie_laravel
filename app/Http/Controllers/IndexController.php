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
    public function __construct()
    {
        $this->category             = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $this->genre                = Genre::orderBy('id', 'DESC')->where('status', 1)->get();
        $this->country              = Country::orderBy('id', 'DESC')->where('status', 1)->get();
        $this->movie_hot_sidebar    = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get();
        $this->movie_hot_trailer    = Movie::where('resolution', 5)->where('status', 1)->orderBy('update_day', 'DESC')->take(6)->get();
    }

    public function search()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];

            $category           = $this->category;
            $movie              = Movie::where('title', 'LIKE', '%' . $search . '%')->orderBy('update_day', 'DESC')->paginate(8); //get => all movie || paginate    => limited
            $movie_hot_sidebar  = $this->movie_hot_sidebar; //sidebar phimhot
            $movie_hot_trailer  = $this->movie_hot_trailer; //sidebar phim trailer

            $genre              = $this->genre;
            $country            = $this->country;
            return view('pages.search', compact('category', 'genre', 'country', 'search', 'movie', 'movie_hot_sidebar', 'movie_hot_trailer'));
        } else {
            return redirect()->to('/');
        }
    }
    // controll page pages/home
    public function home()
    {
        $movie_hot          = Movie::where('movie_hot', 1)->where('status', 1)->orderBy('create_day', 'DESC')->get(); //phimhot slider
        $movie_hot_sidebar  = $this->movie_hot_sidebar; //sidebar phimhot
        $movie_hot_trailer  = $this->movie_hot_trailer; //sidebar phim trailer
        $category           = $this->category;
        $genre              = $this->genre;
        $country            = $this->country;
        $movie              = Movie::orderBy('update_day', 'DESC')->get(); //Sắp xếp theo update_day mới nhất
        $category_home      = Category::with('movie')->orderBy('id', 'DESC')->where('status', 1)->get();

        return view('pages.home', compact('category', 'genre', 'country', 'category_home', 'movie', 'movie_hot', 'movie_hot_sidebar', 'movie_hot_trailer'));
    }

    // controll page pages/category
    public function category($slug)
    {
        $category           = $this->category;
        $cate_slug          = Category::where('slug', $slug)->first();
        $movie              = Movie::where('category_id', $cate_slug->id)->orderBy('update_day', 'DESC')->paginate(8); //get => all movie || paginate    => limited
        $movie_hot_sidebar  = $this->movie_hot_sidebar; //sidebar phimhot
        $movie_hot_trailer  = $this->movie_hot_trailer; //sidebar phim trailer

        $genre              = $this->genre;
        $country            = $this->country;
        return view('pages.category', compact('category', 'genre', 'country', 'cate_slug', 'movie', 'movie_hot_sidebar', 'movie_hot_trailer'));
    }

    //year
    public function year($year)
    {
        $category           = $this->category;
        $year               = $year;
        $movie              = Movie::where('year', $year)->orderBy('update_day', 'DESC')->paginate(8); //get => all movie || paginate  => limited
        $movie_hot_sidebar  = $this->movie_hot_sidebar; //sidebar phimhot
        $movie_hot_trailer  = $this->movie_hot_trailer; //sidebar phim trailer

        $genre              = $this->genre;
        $country            = $this->country;
        return view('pages.year', compact('category', 'genre', 'country', 'year', 'movie', 'movie_hot_sidebar', 'movie_hot_trailer'));
    }

    //tag
    public function tag($tag)
    {
        $category           = $this->category;
        $tag                = $tag;
        $movie              = Movie::where('tags', 'LIKE', '%' . $tag . '%')->orderBy('update_day', 'DESC')->paginate(8); //get => all movie || paginate => limited
        $movie_hot_sidebar  = $this->movie_hot_sidebar; //sidebar phimhot
        $movie_hot_trailer  = $this->movie_hot_trailer; //sidebar phim trailer

        $genre              = $this->genre;
        $country            = $this->country;
        return view('pages.tag', compact('category', 'genre', 'country', 'tag', 'movie', 'movie_hot_sidebar', 'movie_hot_trailer'));
    }

    // controll page pages/genre
    public function genre($slug)
    {
        $category           = $this->category;
        $genre_slug         = Genre::where('slug', $slug)->first();
        $genre              = $this->genre;
        $country            = $this->country;

        $movie_hot_sidebar  = $this->movie_hot_sidebar; //sidebar phimhot
        $movie_hot_trailer  = $this->movie_hot_trailer; //sidebar phim trailer
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
    public function country($slug)
    {
        $category           = $this->category;
        $country_slug       = Country::where('slug', $slug)->first();
        $movie              = Movie::where('country_id', $country_slug->id)->orderBy('update_day', 'DESC')->paginate(8);
        $movie_hot_sidebar  = $this->movie_hot_sidebar; //sidebar phimhot
        $movie_hot_trailer  = $this->movie_hot_trailer; //sidebar phim trailer

        $genre              = $this->genre;
        $country            = $this->country;
        return view('pages.country', compact('category', 'genre', 'country', 'country_slug', 'movie', 'movie_hot_sidebar', 'movie_hot_trailer'));
    }

    // go to page chi tiết phim
    public function movie($slug)
    {
        $category           = $this->category;
        $genre              = $this->genre;
        $country            = $this->country;

        $movie              = Movie::with('category', 'country', 'genre', 'movie_genre')->where('slug', $slug)->where('status', 1)->first();
        //lấy tập phim theo phim
        $movie_episode      = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'ASC')->take(1)->first();

        $movie_hot_sidebar  = $this->movie_hot_sidebar; //sidebar phimhot
        $movie_hot_trailer  = $this->movie_hot_trailer; //sidebar phim trailer


        //Lấy những phim liên quan / cùng 'QUỐC GIA'. Trừ phim đang chọn
        // $movie_related  = Movie::with('category', 'country', 'genre')->where('country_id', $movie->country->id)->orderBy(DB::raw('RAND()'))->WhereNotIn('slug',[$slug])->get();

        //Lấy những phim liên quan / cùng 'THỂ LOẠI'. Trừ phim đang chọn
        // $movie_related  = Movie::with('category', 'country', 'genre')->where('genre_id', $movie->genre->id)->orderBy(DB::raw('RAND()'))->WhereNotIn('slug',[$slug])->get();

        //Lấy những phim liên quan / cùng 'DANH MỤC'. Trừ phim đang chọn
        $movie_related  = Movie::with('category', 'country', 'genre')->where('category_id', $movie->category->id)->orderBy(DB::raw('RAND()'))->WhereNotIn('slug', [$slug])->get();

        //lấy 3 tập gần nhất
        $episode        = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'DESC')->take(3)->get();

        //lấy tổng số tập phim đã thêm
        $episode_current_list        = Episode::with('movie')->where('movie_id', $movie->id)->get();
        $episode_current_list_count  = $episode_current_list->count();

        return view('pages.movie', compact('category', 'genre', 'country', 'movie', 'movie_related', 'movie_hot_sidebar', 'movie_hot_trailer', 'episode', 'movie_episode', 'episode_current_list_count'));
    }

    // go to page xem phim
    public function watch($slug, $tap)
    {
        $category           = $this->category;
        $genre              = $this->genre;
        $country            = $this->country;
        $movie_hot_sidebar  = $this->movie_hot_sidebar; //sidebar phimhot
        $movie_hot_trailer  = $this->movie_hot_trailer; //sidebar phim trailer

        $movie              = Movie::with('category', 'country', 'genre', 'movie_genre', 'episode')->where('slug', $slug)->where('status', 1)->first();
        //phim liên quan theo thể loại
        $movie_related  = Movie::with('category', 'country', 'genre')->where('genre_id', $movie->genre->id)->orderBy(DB::raw('RAND()'))->WhereNotIn('slug', [$slug])->get();

        if (isset($tap)) {
            $tapphim = $tap;
            $tapphim = substr($tap, 4, 10);
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        } else {
            $tapphim = 1;
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        }
        // dd($tapphim);

        // return response()->json($movie);
        return view('pages.watch', compact('category', 'genre', 'country', 'movie', 'movie_hot_sidebar', 'movie_hot_trailer', 'episode', 'tapphim', 'movie_related'));
    }

    // go to page tập phim
    public function episode()
    {
        $category           = $this->category;
        $genre              = $this->genre;
        $country            = $this->country;
        $movie_hot_sidebar  = $this->movie_hot_sidebar; //sidebar phimhot
        $movie_hot_trailer  = $this->movie_hot_trailer; //sidebar phim trailer

        $movie              = Movie::with('category', 'country', 'genre', 'movie_genre', 'episode')->where('status', 1)->first();

        return view('pages.episode',  compact('category', 'genre', 'country', 'movie', 'movie_hot_sidebar', 'movie_hot_trailer'));
    }
}
