@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold">Quản lý phim <a href="{{route('movie.index')}}" class="btn btn-primary">Danh sách phim</a></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (!isset($movie))
                            {!! Form::open(['method' => 'POST', 'route' => 'movie.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                        @else
                            {!! Form::open(['method' => 'PUT', 'route' => ['movie.update', $movie->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                        @endif

                        <div class="form-group" style="display: flex; gap: 20px;">
                            <div class="form-group-title" style="flex-grow: 1;">
                                {!! Form::label('title', 'Tên phim', []) !!}
                                {!! Form::text('title', isset($movie) ? $movie->title : '', ['class' => 'form-control', 'placeholder' => 'Nhập tên phim ...', 'id' => 'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
                                {{-- {!! Form::submit('Add', ['class' => 'btn btn-success']) !!} --}}
                            </div>

                            <div class="form-group-name_eng" style="flex-grow: 1;">
                                {!! Form::label('name_eng', 'Tên tiếng Anh', []) !!}
                                {!! Form::text('name_eng', isset($movie) ? $movie->name_eng : '', ['class' => 'form-control', 'placeholder' => 'Nhập tên phim ...']) !!}
                            </div>

                            <div class="form-group_slug" style="flex-grow: 1;">
                                {!! Form::label('slug', 'Slug phim', []) !!}
                                {!! Form::text('slug', isset($movie) ? $movie->slug : '', ['class' => 'form-control', 'placeholder' => 'Slug phim ...', 'id' => 'convert_slug']) !!}
                            </div>
                            <div class="form-group_trailer" style="flex-grow: 1;">
                                {!! Form::label('trailer', 'Trailer phim', []) !!}
                                {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', ['class' => 'form-control', 'placeholder' => 'trailer phim ...', 'id' => 'convert_trailer']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Nội dung phim', []) !!}
                            {!! Form::textarea('description', isset($movie) ? $movie->description : '', ['style' => 'resize:none', 'class' => 'form-control', 'placeholder' => 'Nội dung chính ...', 'id' => 'description']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('tags', 'Từ khóa phim', []) !!}
                            {!! Form::textarea('tags', isset($movie) ? $movie->tags : '', ['style' => 'resize:none', 'class' => 'form-control', 'placeholder' => 'Nhập từ khóa ...']) !!}
                        </div>

                        <div class="form-group" style="display: flex; gap: 20px;">
                            <div class="form-group-status" style="flex-grow: 1;">
                                {!! Form::label('Active', 'Trạng thái', []) !!}
                                {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không hiển thị'], isset($movie) ? $movie->status : null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group-resolution" style="flex-grow: 1;">
                                {!! Form::label('resolution', 'Định dạng', []) !!}
                                {!! Form::select('resolution', ['0' => 'HD', '1' => 'SD','2' => 'HDCam', '3' => 'Cam', '4' => 'FULLHD', '5' => 'Trailer'], isset($movie) ? $movie->resolution : null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group-cc" style="flex-grow: 1;">
                                {!! Form::label('cc', 'Phụ đề', []) !!}
                                {!! Form::select('cc', ['0' => 'Phụ đề', '1' => 'Thuyết minh'], isset($movie) ? $movie->cc : null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group-cc" style="flex-grow: 1;">
                                {!! Form::label('time', 'Thời lượng', []) !!}
                                {!! Form::text('time', isset($movie) ? $movie->time : '', ['class' => 'form-control', 'placeholder' => ' 133 phút']) !!}
                            </div>
                        </div>

                        {{-- field ngoại  --}}
                        <div class="form-group" style="display: flex; gap: 20px;">
                            <div class="movie_hot" style="flex-grow: 1;">
                                {!! Form::label('movie_hot', 'Phim hot', []) !!}
                                {!! Form::select('movie_hot', ['1' => 'Có', '0' => 'Không'] , isset($movie) ? $movie->movie_hot : null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="category" style="flex-grow: 1;">
                                {!! Form::label('Category', 'Danh mục phim', []) !!}
                                {!! Form::select('category_id', $category , isset($movie) ? $movie->category_id : null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="country" style="flex-grow: 1;">
                                {!! Form::label('Country', 'Quốc gia', []) !!}
                                {!! Form::select('country_id', $country , isset($movie) ? $movie->country_id : null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        {{-- Thể loại  --}}
                        <div class="genre" style="flex-grow: 1;">
                            {!! Form::label('Genre', 'Thể loại', []) !!}
                            <br>
                            {{-- {!! Form::select('genre_id', $genre , isset($movie) ? $movie->genre_id : null, ['class' => 'form-control']) !!} --}}
                            @foreach ($list_genre as $key => $gen )
                                {!! Form::checkbox('genre[]', $gen->id, isset($movie) ? ((isset ($movie_genre) && $movie_genre->contains($gen->id)) ? true : false) : '') !!}  {{--  True = checked --}}
                                {!! Form::label('genre', $gen->title, []) !!}
                                <br>
                            @endforeach
                        </div>

                        {{-- hình ảnh phim  --}}
                        <div class="form-group">
                            {!! Form::label('Image', 'Hình ảnh', []) !!}
                            {!! Form::file('image', ['class' => 'form-control-file']) !!}
                        </div>
                        @if (isset($movie))
                            <img width="15%" style="object-fit: cover;" src="{{asset('/uploads/movie/'.$movie->image)}}" alt="">
                            <br>
                        @endif

                        {{-- {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!} --}}
                        @if (!isset($movie))
                            {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
                            {!! Form::submit('Thêm phim', ['class' => 'btn btn-info pull-right']) !!}
                        @else
                            <br>
                            {!! Form::submit('Cập nhật', ['class' => 'btn btn-info pull-right']) !!}
                        @endif

                        {!! Form::close() !!}
                    </div>
                </div>

                <br>
                {{-- list --}}
                <table class="table table-hover table-bordered" id="tableMovie">
                    <thead class="">
                        <tr class="bg-primary">
                            <th scope="col">#</th>
                            <th scope="col">Tên phim</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Trailer</th>
                            <th scope="col">Định dạng</th>
                            {{-- <th scope="col">Phụ đề</th> --}}
                            <th scope="col">Thời lượng</th>
                            {{-- <th scope="col">Slug</th> --}}
                            {{-- <th scope="col">Mô tả phim</th> --}}
                            {{-- <th scope="col">Từ khóa</th> --}}
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Quốc gia</th>
                            <th scope="col">Thể loại</th>
                            {{-- <th scope="col">Ngày tạo</th> --}}
                            <th scope="col">Ngày cập nhật</th>
                            <th scope="col" class="col-1">Năm phim</th>
                            <th scope="col" class="col-1">Top views</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($list as $key => $movie)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $movie->title }}</td>
                                <td><img width="60%" src="{{asset('/uploads/movie/'.$movie->image)}}" alt=""></td>
                                <td>{{ $movie->trailer }}</td>
                                <td>
                                    @if ($movie->resolution == 0)
                                        HD
                                    @elseif ($movie->resolution == 1)
                                        SD
                                    @elseif ($movie->resolution == 2)
                                        HDCam
                                    @elseif ($movie->resolution == 3)
                                        Cam
                                    @elseif ($movie->resolution == 4)
                                        FULLHD
                                    @else
                                        Trailer
                                    @endif
                                </td>
                                {{-- <td>
                                    @if ($movie->cc == 0)
                                        Phụ đề
                                    @elseif ($movie->cc == 1)
                                        Thuyết minh
                                    @endif
                                </td> --}}
                                <td>{{ $movie->time }}</td>
                                {{-- <td>{{ $movie->slug }}</td> --}}
                                {{-- <td>{{ $movie->description }}</td> --}}
                                {{-- <td>{{ $movie->tags }}</td> --}}

                                <td>
                                    @if ($movie->status)
                                        Hiển thị
                                    @else
                                        Không hiển thị
                                    @endif
                                </td>

                                <td>{{ $movie->category->title }}</td>
                                <td>{{ $movie->country->title }}</td>

                                <td>
                                    @foreach ($movie->movie_genre as $gen)
                                        <span class="badge badge-warning">{{ $gen->title }}</span>
                                    @endforeach
                                </td>


                                {{-- <td>{{ $movie->create_day }}</td> --}}
                                <td>{{ $movie->update_day }}</td>
                                <td>
                                    {!! Form::selectYear('year', 2017, 2022, isset($movie->year) ? $movie->year : '' , ['class' => 'select-year custom-select', 'id' => $movie->id]) !!}
                                </td>
                                <td>
                                    {!! Form::select('topview', ['0' => 'Ngày', '1' => 'Tuần', '2' => 'Tháng'], isset($movie) ? $movie->topview : '', ['class' => 'select-topview custom-select', 'id' => $movie->id]) !!}
                                </td>

                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['movie.destroy', $movie->id], 'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa phim?")']) !!}
                                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                    <a href="{{ route('movie.edit', $movie->id) }}" class="btn btn-warning">Sửa</a>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
