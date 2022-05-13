@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold">Quản lý phim</div>

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
                        <div class="form-group">
                            {!! Form::label('title', 'Tên phim', []) !!}
                            {!! Form::text('title', isset($movie) ? $movie->title : '', ['class' => 'form-control', 'placeholder' => 'Nhập tên phim ...', 'id' => 'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
                            {{-- {!! Form::submit('Add', ['class' => 'btn btn-success']) !!} --}}
                        </div>

                        <div class="form-group">
                            {!! Form::label('slug', 'Slug phim', []) !!}
                            {!! Form::text('slug', isset($movie) ? $movie->slug : '', ['class' => 'form-control', 'placeholder' => 'Slug phim ...', 'id' => 'convert_slug']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Nội dung phim', []) !!}
                            {!! Form::textarea('description', isset($movie) ? $movie->description : '', ['style' => 'resize:none', 'class' => 'form-control', 'placeholder' => 'Nội dung chính ...', 'id' => 'description']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Active', 'Trạng thái', []) !!}
                            {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không hiển thị'], isset($movie) ? $movie->status : null, ['class' => 'form-control']) !!}
                        </div>

                        {{-- field ngoại  --}}
                        <div class="form-group">
                            {!! Form::label('Category', 'Danh mục phim', []) !!}
                            {!! Form::select('category_id', $category , isset($movie) ? $movie->category_id : null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Country', 'Quốc gia', []) !!}
                            {!! Form::select('country_id', $country , isset($movie) ? $movie->country_id : null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Genre', 'Thể loại', []) !!}
                            {!! Form::select('genre_id', $genre , isset($movie) ? $movie->genre_id : null, ['class' => 'form-control']) !!}
                        </div>

                        {{-- hình ảnh phim  --}}
                        <div class="form-group">
                            {!! Form::label('Image', 'Hình ảnh', []) !!}
                            {!! Form::file('image', ['class' => 'form-control-file']) !!}
                        </div>
                        @if (isset($movie))
                            <img width="20%" style="object-fit: cover;" src="{{asset('/uploads/movie/'.$movie->image)}}" alt="">
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
                            <th scope="col">Slug</th>
                            {{-- <th scope="col" class="col-3">Mô tả phim</th> --}}
                            <th scope="col">Trạng thái</th>
                            <th scope="col" class="col-1">Danh mục</th>
                            <th scope="col" class="col-1">Quốc gia</th>
                            <th scope="col" class="col-1">Thể loại</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($list as $key => $movie)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $movie->title }}</td>
                                <td><img width="100%" src="{{asset('/uploads/movie/'.$movie->image)}}" alt=""></td>
                                <td>{{ $movie->slug }}</td>
                                {{-- <td>{{ $movie->description }}</td> --}}

                                <td>
                                    @if ($movie->status)
                                        Hiển thị
                                    @else
                                        Không hiển thị
                                    @endif
                                </td>

                                <td>{{ $movie->category->title }}</td>
                                <td>{{ $movie->country->title }}</td>
                                <td>{{ $movie->genre->title }}</td>

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
