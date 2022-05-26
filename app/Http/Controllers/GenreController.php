<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Genre::all();
        return view('admin.genre.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Genre::all();
        return view('admin.genre.form', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $genre = new Genre();

        $genre->title       = $data['title'];
        $genre->slug        = $data['slug'];
        $genre->description = $data['description'];
        $genre->status      = $data['status'];

        $genre->save();

        return redirect()->route('genre.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //compact : truyền data ra view để view có thể dùng được 2 biến $list và $genre || dùng with || dùng array
        $genre = Genre::find($id);
        $list = Genre::all();
        return view('admin.genre.form', compact('list', 'genre'));

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
        //Để nhận tất cả dữ liệu input gửi lên request
        $data = $request->all();

        //Tim phim theo id trong table genre
        $genre = Genre::find($id);

        $genre->title       = $data['title'];
        $genre->slug        = $data['slug'];
        $genre->description = $data['description'];
        $genre->status      = $data['status'];

        $genre->save();

        return redirect()->route('genre.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Genre::find($id)->delete();
        return redirect()->back();

    }
}
