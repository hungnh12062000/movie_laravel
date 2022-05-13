@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold">QUẢN LÝ QUỐC GIA</div>

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
                            <th scope="col" class="col-2">Tên quốc gia</th>
                            <th scope="col" class="col-2">Slug</th>
                            <th scope="col" class="col-4">Mô tả</th>
                            <th scope="col" class="col-2">Trạng thái</th>
                            <th scope="col" class="col-2">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($list as $key => $coun)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $coun->title }}</td>
                                <td>{{ $coun->slug }}</td>
                                <td>{{ $coun->description }}</td>
                                <td>
                                    @if ($coun->status)
                                        Hiển thị
                                    @else
                                        Không hiển thị
                                    @endif
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['country.destroy', $coun->id], 'onsubmit' => 'return confirm("Bạn có chắc chắn muốn xóa phim?")']) !!}
                                    {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                    <a href="{{ route('country.edit', $coun->id) }}" class="btn btn-warning">Sửa</a>
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
