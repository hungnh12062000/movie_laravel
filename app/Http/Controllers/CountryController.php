<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "hello";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Country::all();
        return view('admin.country.form', compact('list'));
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
        $country = new Country();

        $country->title = $data['title'];
        $country->slug = $data['slug'];
        $country->description = $data['description'];
        $country->status = $data['status'];

        $country->save();

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
        //compact : truyền data ra view để view có thể dùng được 2 biến $list và $country || dùng with || dùng array
        $country = Country::find($id);
        $list = Country::all();
        return view('admin.country.form', compact('list', 'country'));
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

        //Tim phim theo id trong table country
        $country = Country::find($id);

        $country->title = $data['title'];
        $country->slug = $data['slug'];
        $country->description = $data['description'];
        $country->status = $data['status'];

        $country->save();

        return redirect()->route('country.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Country::find($id)->delete();
        return redirect()->back();
    }
}
