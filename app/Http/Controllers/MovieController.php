<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie_Genre;
use App\Models\Episode;

// Xử lý datetime trong Laravel
use Carbon\Carbon;

use File;

class MovieController extends Controller
{
    private $path_view_controller = 'admin.movie.';

    public function __construct()
    {
        $this->carbon = Carbon::now('Asia/Ho_Chi_Minh');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list       = Movie::with('category', 'country', 'movie_genre', 'genre')->orderBy('id', 'DESC')->get();
        // return response()->json($list);

        $path       = public_path().'/json_file';
        if(!is_dir($path)){
            mkdir($path, 07777, true); //create folder json_file và cấp quyền thêm sửa xóa
        }
        File::put($path.'/movies.json', json_encode($list));

        return view($this->path_view_controller . 'index', compact('list'));
    }

    //TOP VIEWS
    public function update_year(Request $request)
    {
        $data           = $request->all();
        $movie          = Movie::find($data['id_movie']);
        $movie->year    = $data['year'];
        $movie->save();
    }

    public function update_topview(Request $request)
    {
        $data               = $request->all();
        $movie              = Movie::find($data['id_movie']);
        $movie->topview     = $data['topview'];
        $movie->save();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //1 Collection chứa mảng các 'title' và 'id' của category || country || genre
        $category   = Category::pluck('title', 'id');
        $country    = Country::pluck('title', 'id');
        $genre      = Genre::pluck('title', 'id');
        $list_genre = Genre::all();

        $list       = Movie::with('category', 'country', 'movie_genre', 'genre')->orderBy('id', 'DESC')->get();
        return view($this->path_view_controller . 'form', compact('list', 'category', 'country', 'genre', 'list_genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data   = $request->all();
        $movie  = new Movie();

        $movie->title       = $data['title'];
        $movie->resolution  = $data['resolution'];
        $movie->cc          = $data['cc'];
        $movie->name_eng    = $data['name_eng'];
        $movie->description = $data['description'];
        $movie->status      = $data['status'];
        $movie->slug        = $data['slug'];
        $movie->category_id = $data['category_id'];
        $movie->country_id  = $data['country_id'];
        foreach ( $data['genre'] as $key => $gen){
            $movie->genre_id = $gen[0];
        }

        $movie->create_day          = $this->carbon;
        $movie->update_day          = $this->carbon;
        $movie->time                = $data['time'];
        $movie->tags                = $data['tags'];
        $movie->movie_hot           = $data['movie_hot'];
        $movie->trailer             = $data['trailer'];
        // $movie->episode_number      = $data['episode_number']; //check


        //add image
        $get_image = $request->file('image');
        $path      = 'uploads/movie/';
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName(); //image.png
            $name_image     = current(explode('.', $get_name_image)); //=> image
            $new_image      = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension(); //image1234.png
            $get_image->move($path, $new_image);
            $movie->image   = $new_image;
        }
        $movie->save();

        // thêm nhiều genre cho movie
        $movie->movie_genre()->attach($data['genre']);

        return redirect()->route('movie.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('movie.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $category       = Category::pluck('title', 'id');
        $country        = Country::pluck('title', 'id');
        $genre          = Genre::pluck('title', 'id');
        $list_genre     = Genre::all();
        $list           = Movie::with('category', 'country', 'genre')->orderBy('id', 'DESC')->get();

        $movie          = Movie::find($id);
        $movie_genre    = $movie->movie_genre;
        return view($this->path_view_controller . 'form', compact('list', 'category', 'country', 'genre', 'movie', 'list_genre', 'movie_genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data   = $request->all();
        $movie  = Movie::find($id);

        $movie->title       = $data['title'];
        $movie->name_eng    = $data['name_eng'];
        $movie->description = $data['description'];
        $movie->resolution  = $data['resolution'];
        $movie->cc          = $data['cc'];
        $movie->status      = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->country_id  = $data['country_id'];
        // $movie->genre_id    = $data['genre_id'];
        foreach ( $data['genre'] as $key => $gen){
            $movie->genre_id = $gen[0];
        }
        $movie->slug                = $data['slug'];
        $movie->update_day          = $this->carbon;
        $movie->time                = $data['time'];
        $movie->tags                = $data['tags'];
        $movie->movie_hot           = $data['movie_hot'];
        $movie->trailer             = $data['trailer'];
        // $movie->episode_number      = $data['episode_number']; //check

        //delete old image then update new image
        $get_image = $request->file('image');
        $path      = 'uploads/movie/';
        if ($get_image) {
            if (!empty($movie->image)) {
                unlink('uploads/movie/' . $movie->image);
            }
            $get_name_image = $get_image->getClientOriginalName(); //image.png
            $name_image     = current(explode('.', $get_name_image)); //=> image
            $new_image      = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension(); //image1234.png
            $get_image->move($path, $new_image);
            $movie->image   = $new_image;
        }

        $movie->save();
        $movie->movie_genre()->sync($data['genre']);

        return redirect()->route('movie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);

        //delete image when delete movie
        if (!empty($movie->image) ) {
            unlink('uploads/movie/' . $movie->image);
        }

        //xóa thể loại
        Movie_Genre::whereIn('movie_id', [$movie->id])->delete();

        //Xóa tập phim
        Episode::whereIn('movie_id', [$movie->id])->delete();

        //xóa phim
        $movie->delete();

        return redirect()->route('movie.index');
    }
}
