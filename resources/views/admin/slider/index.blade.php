@extends('admin.main') {{-- all file main in here --}}

@section('content')
    <div class="page-header zvn-page-header clearfix">
        <div class="zvn-page-header-title">
            <h3>Danh sách phim</h3>
        </div>
        <div class="zvn-add-new pull-right">
            <a href="/form" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</a>
        </div>
    </div>

    <!--box-lists-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Danh sách</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                @include('admin.slider.list')
            </div>
        </div>
    </div>
    <!--end-box-lists-->
    <!--box-pagination-->
    {{-- <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Phân trang
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="m-b-0">Số phần tử trên trang: <b>2</b> trên <span
                                    class="label label-success label-pagination">3 trang</span></p>
                            <p class="m-b-0">Hiển thị<b> 1 </b> đến<b> 2</b> trên<b> 6</b> Phần tử</p>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination zvn-pagination">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">«</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">»</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!--end-box-pagination-->
@endsection
