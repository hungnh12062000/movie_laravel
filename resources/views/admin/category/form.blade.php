@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold">QUẢN LÝ DANH MỤC</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (!isset($category))
                            {!! Form::open(['method' => 'POST', 'route' => 'category.store', 'class' => 'form-horizontal']) !!}
                        @else
                            {!! Form::open(['method' => 'PUT', 'route' => ['category.update', $category->id], 'class' => 'form-horizontal']) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Tên danh mục phim', []) !!}
                            {!! Form::text('title', isset($category) ? $category->title : '', ['class' => 'form-control', 'placeholder' => 'Nhập tên danh mục phim ...', 'id' => 'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
                            {{-- {!! Form::submit('Add', ['class' => 'btn btn-success']) !!} --}}
                        </div>

                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($category) ? $category->slug : '', ['class' => 'form-control', 'placeholder' => 'Slug danh mục phim ...', 'id' => 'convert_slug']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả', []) !!}
                            {!! Form::textarea('description', isset($category) ? $category->description : '', ['style' => 'resize:none', 'class' => 'form-control', 'placeholder' => 'Mô tả danh mục phim ...', 'id' => 'description']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Active', 'Trạng thái', []) !!}
                            {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không hiển thị'], isset($category) ? $category->status : null, ['class' => 'form-control']) !!}
                        </div>

                        {{-- {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!} --}}
                        @if (!isset($category))
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
                            <th scope="col" class="col-2">Tên danh mục phim</th>
                            <th scope="col" class="col-2">Slug</th>
                            <th scope="col" class="col-4">Mô tả</th>
                            <th scope="col" class="col-2">Trạng thái</th>
                            <th scope="col" class="col-2">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($list as $key => $cate)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $cate->title }}</td>
                                <td>{{ $cate->slug }}</td>
                                <td>{{ $cate->description }}</td>
                                <td>
                                    @if ($cate->status)
                                        Hiển thị
                                    @else
                                        Không hiển thị
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['category.destroy', $cate->id], 'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa phim?")']) !!}
                                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!} &nbsp
                                    <a href="{{ route('category.edit', $cate->id) }}" class="btn btn-warning">Sửa</a>
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
