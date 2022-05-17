<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;

// Xử lý datetime trong Laravel
use Carbon\Carbon;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    //update year
    public function update_year(Request $request)
    {
        $data           = $request->all();
        $movie          = Movie::find($data['id_movie']);
        $movie->year    = $data['year'];
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

        $list       = Movie::with('category', 'country', 'genre')->orderBy('id', 'DESC')->get();
        return view('admin.movie.form', compact('list', 'category', 'country', 'genre'));
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
        $movie->genre_id    = $data['genre_id'];
        $movie->create_day  = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->update_day  = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->time        = $data['time'];
        $movie->tags        = $data['tags'];

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
        return redirect()->back();
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
        $movie      = Movie::find($id);

        $category   = Category::pluck('title', 'id');
        $country    = Country::pluck('title', 'id');
        $genre      = Genre::pluck('title', 'id');
        $list       = Movie::with('category', 'country', 'genre')->orderBy('id', 'DESC')->get();
        return view('admin.movie.form', compact('list', 'category', 'country', 'genre', 'movie'));
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
        $movie->genre_id    = $data['genre_id'];
        $movie->slug        = $data['slug'];
        $movie->update_day  = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->time        = $data['time'];
        $movie->tags        = $data['tags'];

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
        return redirect()->route('movie.create');
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
        if (!empty($movie->image)) {
            unlink('uploads/movie/' . $movie->image);
        }
        $movie->delete();
        return redirect()->route('movie.create');
    }
}
