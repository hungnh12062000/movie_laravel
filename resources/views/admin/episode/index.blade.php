@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
                {{-- list --}}
                <table class="table table-hover">
                    <thead class="">
                        <tr class="bg-primary">
                            <th scope="col" class="">#</th>
                            <th scope="col" class="col-2">Tên phim</th>
                            <th scope="col" class="col-1">tập phim </th>
                            <th scope="col" class="col-7">Link phim</th>
                            {{-- <th scope="col" class="col-2">Trạng thái</th> --}}
                            <th scope="col" class="col-2">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($list_episode as $key => $episode)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $episode->movie->title }}</td>
                                <td>{{ $episode->episode }}</td>
                                <td>
                                    <style>
                                        .iframe_movie iframe{
                                            width: 100%;
                                            height: 350px;
                                        }
                                    </style>
                                    <div class="iframe_movie">
                                        {!! $episode->link_movie !!}
                                    </div>
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['episode.destroy', $episode->id], 'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa phim?")']) !!}
                                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!} &nbsp
                                    <a href="{{ route('episode.edit', $episode->id) }}" class="btn btn-warning">Sửa</a>
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
