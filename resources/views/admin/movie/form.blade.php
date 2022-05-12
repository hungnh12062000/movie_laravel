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

                        @if (!isset($genre))
                            {!! Form::open(['method' => 'POST', 'route' => 'genre.store', 'class' => 'form-horizontal']) !!}
                        @else
                            {!! Form::open(['method' => 'PUT', 'route' => ['genre.update', $genre->id], 'class' => 'form-horizontal']) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($genre) ? $genre->title : '', ['class' => 'form-control', 'placeholder' => 'Nhập vào dữ liệu ...', 'id' => 'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
                            {{-- {!! Form::submit('Add', ['class' => 'btn btn-success']) !!} --}}
                        </div>

                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($genre) ? $genre->slug : '', ['class' => 'form-control', 'placeholder' => 'Nhập vào dữ liệu ...', 'id' => 'convert_slug']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($genre) ? $genre->description : '', ['style' => 'resize:none', 'class' => 'form-control', 'placeholder' => 'Nhập vào dữ liệu ...', 'id' => 'description']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Active', 'Active', []) !!}
                            {{-- {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], null, ['class' => 'form-control']) !!} --}}
                            {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($genre) ? $genre->status : null, ['class' => 'form-control']) !!}
                        </div>

                        {{-- {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!} --}}
                        @if (!isset($genre))
                        {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
                            {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-info pull-right']) !!}
                        @else
                            {!! Form::submit('Cập nhật', ['class' => 'btn btn-info pull-right']) !!}
                        @endif

                        {!! Form::close() !!}
                    </div>
                </div>

                <br>
                {{-- list --}}
                <table class="table table-hover">
                    <thead class="">
                        <tr class="bg-primary">
                            <th scope="col" class="">#</th>
                            <th scope="col" class="col-2">Title</th>
                            <th scope="col" class="col-2">Slug</th>
                            <th scope="col" class="col-4">Description</th>
                            <th scope="col" class="col-2">Active/Inactive</th>
                            <th scope="col" class="col-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($list as $key => $gen)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $gen->title }}</td>
                                <td>{{ $gen->slug }}</td>
                                <td>{{ $gen->description }}</td>
                                <td>
                                    @if ($gen->status)
                                        Hiển thị
                                    @else
                                        Không hiển thị
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['genre.destroy', $gen->id], 'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa phim?")']) !!}
                                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                    <a href="{{ route('genre.edit', $gen->id) }}" class="btn btn-warning">Sửa</a>
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
