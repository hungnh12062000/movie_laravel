@extends('admin.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="page-header zvn-page-header clearfix">
                    <div class="zvn-page-header-title">
                        <h3><b>QUẢN LÝ TẬP PHIM</b></h3>
                    </div>
                    <div class="zvn-add-new pull-right">
                        <a href="{{route('episode.create')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>
                    </div>
                </div>
                <br>
                {{-- list TẬP PHIM--}}
                @include('admin.episode.list')

            </div>
        </div>
    </div>
@endsection
