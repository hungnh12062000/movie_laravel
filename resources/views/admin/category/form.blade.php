@extends('admin.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="page-header zvn-page-header clearfix">
                    <div class="zvn-page-header-title">
                        @if (!isset($category))
                            <h3><b>THÊM MỚI DANH MỤC</b></h3>
                        @else
                            <h3><b>CHỈNH SỬA DANH MỤC</b></h3>
                        @endif
                    </div>
                </div>
                <br>
                {{-- Tạo danh mục --}}
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
                            <a class="btn btn-danger pull-right" href="{{ URL::previous() }}">Trở lại</a>
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


