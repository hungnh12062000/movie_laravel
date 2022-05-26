@extends('admin.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="page-header zvn-page-header clearfix">
                        <div class="zvn-page-header-title">
                            @if (!isset($country))
                                <h3><b>THÊM MỚI QUỐC GIA</b></h3>
                            @else
                                <h3><b>CHỈNH SỬA QUỐC GIA</b></h3>
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

                        @if (!isset($country))
                            {!! Form::open(['method' => 'POST', 'route' => 'country.store', 'class' => 'form-horizontal']) !!}
                        @else
                            {!! Form::open(['method' => 'PUT', 'route' => ['country.update', $country->id], 'class' => 'form-horizontal']) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Tên quốc gia', []) !!}
                            {!! Form::text('title', isset($country) ? $country->title : '', ['class' => 'form-control', 'placeholder' => 'Nhập tên quốc gia ...', 'id' => 'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
                            {{-- {!! Form::submit('Add', ['class' => 'btn btn-success']) !!} --}}
                        </div>

                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($country) ? $country->slug : '', ['class' => 'form-control', 'placeholder' => 'Slug quốc gia ...', 'id' => 'convert_slug']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả', []) !!}
                            {!! Form::textarea('description', isset($country) ? $country->description : '', ['style' => 'resize:none', 'class' => 'form-control', 'placeholder' => 'Mô tả quốc gia ...', 'id' => 'description']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Active', 'Trạng thái', []) !!}
                            {{-- {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], null, ['class' => 'form-control']) !!} --}}
                            {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không hiển thị'], isset($country) ? $country->status : null, ['class' => 'form-control']) !!}
                        </div>

                        {{-- {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!} --}}
                        @if (!isset($country))
                            {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
                            {!! Form::submit('Thêm quốc gia', ['class' => 'btn btn-info pull-right']) !!}
                        @else
                            {!! Form::submit('Cập nhật', ['class' => 'btn btn-info pull-right']) !!}
                            <a class="btn btn-danger pull-right" href="{{ URL::previous() }}">Trở lại</a>
                        @endif
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
