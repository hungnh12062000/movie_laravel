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

    // public function filter_default(Request $request)
    // {
    //     $data               = $request->all();
    //     $movie              = Movie::where('topview',0)->orderBy('update_day', 'DESC')->take(6)->get();
    //     $output             = '';

    //     print_r($movie);

    //     foreach ($movie as $key => $mov) {
    //         if ($mov->resolution == 0) {
    //             $text = 'HD';
    //         } else if ($mov->resolution == 1) {
    //             $text = 'SD';
    //         } else if ($mov->resolution == 2) {
    //             $text = 'HDCam';
    //         } else if ($mov->resolution == 3) {
    //             $text = 'Cam';
    //         } else if ($mov->resolution == 4) {
    //             $text = 'FullHD';
    //         } else $text = 'Trailer';

    //         $output .=
    //             '<div class="item post-37176">
    //                 <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
    //                     <div class="item-link">
    //                         <img src="'.url('uploads/movie/'.$mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'"
    //                             title="'.$mov->title.'" />
    //                         <span class="is_trailer">'.$text.'</span>
    //                     </div>
    //                     <p class="title">'.$mov->title.'</p>
    //                 </a>
    //                 <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
    //                 <div style="float: left;">
    //                     <span class="user-rate-image post-large-rate stars-large-vang"
    //                         style="display: block;/* width: 100%; */">
    //                         <span style="width: 0%"></span>
    //                     </span>
    //                 </div>
    //             </div>';
    //     }
    //     echo $output;
    // }

    public function filter_topview(Request $request)
    {
        $data               = $request->all();
        $movie              = Movie::where('topview', $data['value'])->orderBy('update_day', 'DESC')->take(6)->get();
        $output             = '';

        foreach ($movie as $key => $mov) {
            if ($mov->resolution == 0) {
                $text = 'HD';
            } else if ($mov->resolution == 1) {
                $text = 'SD';
            } else if ($mov->resolution == 2) {
                $text = 'HDCam';
            } else if ($mov->resolution == 3) {
                $text = 'Cam';
            } else if ($mov->resolution == 4){
                $text = 'FullHD';
            } else $text = 'Trailer';

            $output .=
                '<div class="item post-37176">
                    <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
                        <div class="item-link">
                            <img src="'.url('uploads/movie/'.$mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'"
                                title="'.$mov->title.'" />
                            <span class="is_trailer">'.$text.'</span>
                        </div>
                        <p class="title">'.$mov->title.'</p>
                    </a>
                    <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                    <div style="float: left;">
                        <span class="user-rate-image post-large-rate stars-large-vang"
                            style="display: block;/* width: 100%; */">
                            <span style="width: 0%"></span>
                        </span>
                    </div>
                </div>';
        }
        echo $output;
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
        $movie->movie_hot   = $data['movie_hot'];
        $movie->trailer     = $data['trailer'];

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
        $movie->movie_hot   = $data['movie_hot'];
        $movie->trailer     = $data['trailer'];

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
