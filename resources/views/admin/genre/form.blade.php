@extends('admin.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="page-header zvn-page-header clearfix">
                    <div class="zvn-page-header-title">
                        @if (!isset($genre))
                            <h3><b>THÊM MỚI THỂ LOẠI</b></h3>
                        @else
                            <h3><b>CHỈNH SỬA THỂ LOẠI</b></h3>
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

                    @if (!isset($genre))
                        {!! Form::open(['method' => 'POST', 'route' => 'genre.store', 'class' => 'form-horizontal']) !!}
                    @else
                        {!! Form::open(['method' => 'PUT', 'route' => ['genre.update', $genre->id], 'class' => 'form-horizontal']) !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('title', 'Tên thể loại', []) !!}
                        {!! Form::text('title', isset($genre) ? $genre->title : '', ['class' => 'form-control', 'placeholder' => 'Nhập tên thể loại ...', 'id' => 'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
                        {{-- {!! Form::submit('Add', ['class' => 'btn btn-success']) !!} --}}
                    </div>

                    <div class="form-group">
                        {!! Form::label('slug', 'Slug', []) !!}
                        {!! Form::text('slug', isset($genre) ? $genre->slug : '', ['class' => 'form-control', 'placeholder' => 'Slug thể loại ...', 'id' => 'convert_slug']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Mô tả', []) !!}
                        {!! Form::textarea('description', isset($genre) ? $genre->description : '', ['style' => 'resize:none', 'class' => 'form-control', 'placeholder' => 'Mô tả thể loại phim ...', 'id' => 'description']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('Active', 'Active', []) !!}
                        {{-- {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], null, ['class' => 'form-control']) !!} --}}
                        {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không hiển thị'], isset($genre) ? $genre->status : null, ['class' => 'form-control']) !!}
                    </div>

                    {{-- {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!} --}}
                    @if (!isset($genre))
                        {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
                        {!! Form::submit('Thêm thể loại', ['class' => 'btn btn-info pull-right']) !!}
                    @else
                        {!! Form::submit('Cập nhật', ['class' => 'btn btn-info pull-right']) !!}
                        <a class="btn btn-danger pull-right" href="{{ URL::previous() }}">Trở lại</a>
                    @endif

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
