@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold">Quản lý tập phim <a href="{{route('episode.index')}}" class="btn btn-primary">Quản lý tập phim</a></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (!isset($episode))
                            {!! Form::open(['method' => 'POST', 'route' => 'episode.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                        @else
                            {!! Form::open(['method' => 'PUT', 'route' => ['episode.update', $episode->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                        @endif


                        {{-- field ngoại  --}}
                        <div class="form-group">
                            <div class="movie_hot">
                                {!! Form::label('movie', 'Chọn phim', []) !!}
                                {!! Form::select('movie_id', ['0' => 'Chọn phim', 'Phim ' => $list_movie] , isset($episode) ? $episode->movie_id : '', ['class' => 'form-control select_movie']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('link', 'Link phim', []) !!}
                            {!! Form::text('link_movie', isset($episode) ? $episode->link_movie : '', ['class' => 'form-control', 'placeholder' => 'Nhập link phim ...']) !!}
                        </div>

                        @if(isset($episode))
                            <div class="form-group">
                                {!! Form::label('episode', 'Tập phim', []) !!}
                                {!! Form::text('episode', isset($episode) ? $episode->episode : '', ['class'=>'form-control','placeholder'=>'...', isset($episode) ? 'readonly' : '']) !!}
                            </div>
                        @else
                            <div class="form-group">
                                {!! Form::label('episode', 'Tập phim', []) !!}
                                <select name="episode" class="form-control" id="show_movie"></select>
                            </div>
                        @endif

                        @if (!isset($episode))
                            {!! Form::submit('Thêm tập phim', ['class' => 'btn btn-info pull-right']) !!}
                        @else
                            <br>
                            {!! Form::submit('Cập nhật tập phim', ['class' => 'btn btn-info pull-right']) !!}
                        @endif
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection