@extends('admin.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="page-header zvn-page-header clearfix">
                    <div class="zvn-page-header-title">
                        @if (!isset($movie))
                            <h3><b>THÊM MỚI PHIM</b></h3>
                        @else
                            <h3><b>CHỈNH SỬA PHIM</b></h3>
                        @endif
                    </div>
                </div>
                <br>
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
                            {!! Form::select('resolution', ['0' => 'HD', '1' => 'SD', '2' => 'HDCam', '3' => 'Cam', '4' => 'FULLHD', '5' => 'Trailer'], isset($movie) ? $movie->resolution : null, ['class' => 'form-control']) !!}
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

                    {{-- field ngoại --}}
                    <div class="form-group" style="display: flex; gap: 20px;">
                        <div class="movie_hot" style="flex-grow: 1;">
                            {!! Form::label('movie_hot', 'Phim hot', []) !!}
                            {!! Form::select('movie_hot', ['1' => 'Có', '0' => 'Không'], isset($movie) ? $movie->movie_hot : null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="category" style="flex-grow: 1;">
                            {!! Form::label('category', 'Danh mục phim', []) !!}
                            {!! Form::select('category_id', $category, isset($movie) ? $movie->category_id : null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="country" style="flex-grow: 1;">
                            {!! Form::label('country', 'Quốc gia', []) !!}
                            {!! Form::select('country_id', $country, isset($movie) ? $movie->country_id : null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group-episode_number" style="flex-grow: 1;">
                            {!! Form::label('episode_number', 'Số tập phim', []) !!}
                            {!! Form::text('episode_number', isset($movie) ? $movie->episode_number : '', ['class' => 'form-control', 'placeholder' => 'Nhập số tập phim ...']) !!}
                        </div>
                    </div>

                    {{-- Thể loại --}}
                    <div class="genre" style="flex-grow: 1;">
                        {!! Form::label('Genre', 'Thể loại', []) !!}
                        <br>
                        {{-- {!! Form::select('genre_id', $genre , isset($movie) ? $movie->genre_id : null, ['class' => 'form-control']) !!} --}}
                        @foreach ($list_genre as $key => $gen)
                            {!! Form::checkbox('genre[]', $gen->id, isset($movie) ? (isset($movie_genre) && $movie_genre->contains($gen->id) ? true : false) : '') !!} {{-- True = checked --}}
                            {!! Form::label('genre', $gen->title, []) !!}
                            <br>
                        @endforeach
                    </div>

                    {{-- hình ảnh phim --}}
                    <div class="form-group">
                        {!! Form::label('Image', 'Hình ảnh', []) !!}
                        {!! Form::file('image', ['class' => 'form-control-file']) !!}
                    </div>
                    @if (isset($movie))
                        <img width="15%" style="object-fit: cover;" src="{{ asset('/uploads/movie/' . $movie->image) }}"
                            alt="">
                        <br>
                    @endif

                    {{-- {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!} --}}
                    @if (!isset($movie))
                        {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
                        {!! Form::submit('Thêm phim', ['class' => 'btn btn-info pull-right']) !!}
                        <a class="btn btn-danger pull-right" href="{{ URL::previous() }}">Trở lại</a>
                    @else
                        <br>
                        {!! Form::submit('Cập nhật', ['class' => 'btn btn-info pull-right']) !!}
                        <a class="btn btn-danger pull-right" href="{{ URL::previous() }}">Trở lại</a>
                    @endif

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
