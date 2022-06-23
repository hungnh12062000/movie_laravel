<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="theme-color" content="#234556">
    <meta http-equiv="Content-Language" content="vi" />
    <meta content="VN" name="geo.region" />
    <meta name="DC.language" scheme="utf-8" content="vi" />
    <meta name="language" content="Việt Nam">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon"
        href="https://www.pngkey.com/png/detail/360-3601772_your-logo-here-your-company-logo-here-png.png"
        type="image/x-icon" />
    <meta name="revisit-after" content="1 days" />
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
    <title>Phim hay 2022 - Xem phim hay nhất</title>
    <meta name="description"
        content="Phim hay 2022 - Xem phim hay nhất, xem phim online miễn phí, phim hot, phim nhanh" />
    <link rel="canonical" href="">
    <link rel="next" href="" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:title" content="Phim hay 2022 - Xem phim hay nhất" />
    <meta property="og:description"
        content="Phim hay 2022 - Xem phim hay nhất, phim hay trung quốc, hàn quốc, việt nam, mỹ, hong kong, chiếu rạp" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="Phim hay 2022 - Xem phim hay nhất" />
    <meta property="og:image" content="" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="55" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">

    <link rel='dns-prefetch' href='//s.w.org' />

    <link rel='stylesheet' id='bootstrap-css' href='{{ asset('css/bootstrap.min.css') }}' media='all' />
    <link rel='stylesheet' id='style-css' href='{{ asset('css/style.css') }}' media='all' />
    <link rel='stylesheet' id='wp-block-library-css' href='{{ asset('css/style.min.css') }}' media='all' />
    <script type='text/javascript' src='{{ asset('js/jquery.min.js') }}' id='halim-jquery-js'></script>
    <style type="text/css" id="wp-custom-css">
        .textwidget p a img {
            width: 100%;
        }
    </style>
    <style>
        #header .site-title {
            background: url(https://www.pngkey.com/png/detail/360-3601772_your-logo-here-your-company-logo-here-png.png) no-repeat top left;
            background-size: contain;
            text-indent: -9999px;
        }
    </style>

    {{-- datatable --}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
</head>

<body class="home blog halimthemes halimmovies" data-masonry="">
    <header id="header">
        <div class="container">
            <div class="row" id="headwrap">
                <div class="col-md-3 col-sm-6 slogan">
                    <p class="site-title"><a class="logo" href="{{ route('homepage') }}" title="phim hay ">Phim Hay
                    </p>
                    </a>
                </div>

                <div class="col-md-5 col-sm-6 halim-search-form hidden-xs">
                    <div class="header-nav">
                        <div class="col-xs-12">
                            <style type="text/css">
                                ul#result {
                                    position: absolute;
                                    z-index: 9999;
                                    background: #1b2d3c;
                                    width: 94%;
                                    padding: 10px;
                                    margin: 1px;
                                    border: 2px solid #000;
                                    border-top: 1px solid transparent;
                                }
                            </style>
                            <div class="form-group form-search">
                                <div class="input-group col-xs-12">
                                    <form action="{{ route('search') }}" method="GET" class="input-search">
                                        <input id="search" type="text" name="search" class="form-control"
                                            placeholder="Tìm kiếm phim..." autocomplete="off" required>
                                        <button class="btn btn-primary">Tìm kiếm</button>
                                    </form>
                                </div>
                            </div>
                            {{-- <ul class="list-group" id="result" style="display: none"></ul> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="navbar-container">
        <div class="container">
            <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
                <div class="collapse navbar-collapse" id="halim">
                    <div class="menu-menu_1-container">
                        <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                            <li class="current-menu-item active"><a title="Trang Chủ"
                                    href="{{ route('homepage') }}">TRANG CHỦ</a></li>
                            <li class="mega dropdown">
                                <a title="Thể Loại" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                    aria-haspopup="true">THỂ LOẠI<span class="caret"></span></a>
                                <ul role="menu" class=" dropdown-menu">
                                    @foreach ($genre as $key => $gen)
                                        <li><a title="{{ $gen->title }}"
                                                href="{{ route('genre', $gen->slug) }}">{{ $gen->title }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="mega dropdown">
                                <a title="Quốc Gia" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                    aria-haspopup="true">QUỐC GIA<span class="caret"></span></a>
                                <ul role="menu" class=" dropdown-menu">
                                    @foreach ($country as $key => $coun)
                                        <li><a title="{{ $coun->title }}"
                                                href="{{ route('country', $coun->slug) }}">{{ $coun->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="mega dropdown">
                                <a title="Năm phim" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                    aria-haspopup="true">NĂM PHIM<span class="caret"></span></a>
                                <ul role="menu" class=" dropdown-menu">
                                    @for ($year = 2017; $year <= 2022; $year++)
                                        <li><a title="{{ $year }}"
                                                href="{{ url('nam/' . $year) }}">{{ $year }}</a>
                                        </li>
                                    @endfor
                                </ul>
                            </li>
                            @foreach ($category as $key => $cate)
                                <li class="mega" style="text-transform: uppercase;"><a
                                        title="{{ $cate->title }}"
                                        href="{{ route('category', $cate->slug) }}">{{ $cate->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    {{-- <ul class="nav navbar-nav navbar-left" style="background:#000;">
                        <li><a href="#" onclick="locphim()" style="color: #ffed4d;">LỌC PHIM</a></li>
                    </ul> --}}
                </div>
            </nav>
            <div class="collapse navbar-collapse" id="search-form">
                <div id="mobile-search-form" class="halim-search-form"></div>
            </div>
            <div class="collapse navbar-collapse" id="user-info">
                <div id="mobile-user-login"></div>
            </div>
        </div>
    </div>
    </div>

    <div class="container">
        <div class="row fullwith-slider"></div>
    </div>

    <div class="container">
        @yield('content')
    </div>
    <div class="clearfix"></div>

    <footer>
        <div class="footer">
            <div class="container">
                <div class="bar">
                    <div class="bar-wrap">
                        <div class="links">
                            <img src="https://www.pngkey.com/png/detail/360-3601772_your-logo-here-your-company-logo-here-png.png"
                                alt="Phim Mới" />
                            <br>
                            <div class="copyright">Copyright 2022 © <a href="#"
                                    title="Phim Mới">XEMPHIMHAY.NET</a> <br />
                                <p>Xem phim mới miễn phí nhanh chất lượng cao. Xem Phim online Việt Sub, Thuyết minh,
                                    lồng tiếng chất lượng HD. Xem phim nhanh online chất lượng cao</p><br />

                            </div>
                        </div>
                        <div class="textlink">
                            <div class="hotlink">
                                <h3 class="phimaz-foot">Phim Mới</h3>
                                <a href="#" title="Phim Lẻ">Phim lẻ mới</a>
                                <a href="#" title="Phim Bộ">Phim bộ mới</a>
                                <a href="#" title="Phim chiếu rạp">Phim chiếu rạp</a>
                                <a href="#" title="Phim sắp chiếu">Phim sắp chiếu</a>
                                <a href="#" title="Phim thuyết minh">Phim thuyết minh</a>
                            </div>
                            <div class="hotlink">
                                <h3 class="phimaz-foot">Phim Lẻ</h3>
                                <a href="#" title="Phim Hành Động">Phim hành động</a>
                                <a href="#" title="Phim kiếm hiệp">Phim kiếm hiệp</a>
                                <a href="#" title="Phim kinh dị">Phim kinh dị</a>
                                <a href="#" title="Phim viễn tưởng">Phim viễn tưởng</a>
                                <a href="#" title="Phim hoạt hình">Phim hoạt hình</a>
                            </div>
                            <div class="hotlink">
                                <h3 class="phimaz-foot">Phim Bộ</h3>
                                <a href="#" title="Phim bộ Hàn Quốc">Phim bộ Hàn Quốc</a>
                                <a href="#" title="Phim bộ Trung Quốc">Phim bộ Trung Quốc</a>
                                <a href="#" title="Phim bộ Mỹ">Phim bộ Mỹ</a>
                                <a href="#" title="Phim bộ Việt Nam">Phim bộ Việt Nam</a>
                                <a href="#" title="Phim bộ Hồng Kông">Phim bộ Hồng Kông</a>
                            </div>

                        </div>
                        {{-- <div class="social"><a href="#" class="call"><span data-icon="7"
                                    class="icon"></span>
                                <span class="info"><span class="follow">Email liên hệ:</span>
                                    <span class="num"><span class="__cf_email__"
                                            data-cfemail="9df8e7edf5f4f0f0f2f4b3f3f8e9ddfaf0fcf4f1b3fef2f0">[email&#160;protected]</span></span></span></a>
                        </div> --}}
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="fb-root"></div>
        <div id='easy-top'></div>
    </footer>

    <script type='text/javascript' src='{{ asset('js/bootstrap.min.js') }}' id='bootstrap-js'></script>
    <script type='text/javascript' src='{{ asset('js/owl.carousel.min.') }}js' id='carousel-js'></script>

    {{-- datatable --}}
    <script type="text/javascript" src="//cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#tableMovie').DataTable();
        } );
    </script>

    {{-- facebook comment --}}
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0&appId=480748059834774&autoLogAppEvents=1"
        nonce="IulYdjEA"></script>

    <script type='text/javascript' src='{{ asset('js/halimtheme-core.min.js?ver=1626273138') }}' id='halim-init-js'>
    </script>

    {{-- search --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#search').keyup(function() {
                $('#result').html('');
                var search = $('#search').val();

                if (search != '') { // 0 empty thì search
                    $('#result').css('display', 'inherit');
                    var expression = new RegExp(search, 'i'); // => /search_val/i
                    $.getJSON('/json/movies.json', function(data) {
                        $.each(data, function(key, value) {
                            if (value.title.search(expression) != -1) {
                                $('#result').append(
                                    '<li style="cursor:pointer; display: flex; max-height: 200px;" class="list-group-item link-class"><img src="uploads/movie/' +
                                    value.image +
                                    '" width="100" class="" style="margin-right: 8px;"/><div style="flex-direction: column; margin-left: 2px;"><h4 width="100%">' +
                                    value.title +
                                    '</h4><span style="display: -webkit-box; max-height: 8.2rem; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; white-space: normal; -webkit-line-clamp: 5; line-height: 1.6rem;" class="text-muted">| ' +
                                    value.description + '</span></div></li>'
                                    );
                            }
                        });
                    })
                } else {
                    $('#result').css('display', 'none');
                }
            });

            $('#result').on('click', 'li', function() {
                var click_text = $(this).text().split('|');

                $('#search').val($.trim(click_text[0])); //title
                $("#result").html('');
                $('#result').css('display', 'none');
            });
        })
    </script>

    {{-- slider --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.filter-sidebar').click(function() {
                let href = $(this).attr('href');
                let value;

                if (href == '#day') {
                    value = 0;
                } else if (href == '#week') {
                    value = 1;
                } else {
                    value = 2;
                }

                $.ajax({
                    // URL muốn sử dụng AJAX để thực hiện request
                    url: "{{ url('/filter-topview-movie') }}",

                    //Kiểu request muốn thực hiện
                    type: "GET",

                    //Dữ liệu được gửi lên server khi thực thi một request Ajax.
                    data: {
                        value: value
                    },

                    //Một hàm được gọi khi request thành công.
                    success: function(data) {
                        $('#show' + value).html(data);
                    }
                });
            });
        })
    </script>

    <script>
        jQuery(document).ready(function($) {
            let owl = $('#halim_related_movies-2');
            owl.owlCarousel({
                loop: true, //lặp đi lặp lại
                margin: 4,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                nav: true,
                navText: ['<i class="fa-solid fa-arrow-left"></i>',
                    '<i class="fa-solid fa-arrow-right"></i>'
                ],
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    480: {
                        items: 3
                    },
                    600: {
                        items: 4
                    },
                    1000: {
                        items: 5
                    }
                }
            })
        });
    </script>

    <style>
        #overlay_mb {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 99999;
            cursor: pointer
        }

        #overlay_mb .overlay_mb_content {
            position: relative;
            height: 100%
        }

        .overlay_mb_block {
            display: inline-block;
            position: relative
        }

        #overlay_mb .overlay_mb_content .overlay_mb_wrapper {
            width: 600px;
            height: auto;
            position: relative;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center
        }

        #overlay_mb .overlay_mb_content .cls_ov {
            color: #fff;
            text-align: center;
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 999999;
            font-size: 14px;
            padding: 4px 10px;
            border: 1px solid #aeaeae;
            background-color: rgba(0, 0, 0, 0.7)
        }

        #overlay_mb img {
            position: relative;
            z-index: 999
        }

        @media only screen and (max-width: 768px) {
            #overlay_mb .overlay_mb_content .overlay_mb_wrapper {
                width: 400px;
                top: 3%;
                transform: translate(-50%, 3%)
            }
        }

        @media only screen and (max-width: 400px) {
            #overlay_mb .overlay_mb_content .overlay_mb_wrapper {
                width: 310px;
                top: 3%;
                transform: translate(-50%, 3%)
            }
        }
    </style>

    <style>
        #overlay_pc {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 99999;
            cursor: pointer;
        }

        #overlay_pc .overlay_pc_content {
            position: relative;
            height: 100%;
        }

        .overlay_pc_block {
            display: inline-block;
            position: relative;
        }

        #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
            width: 600px;
            height: auto;
            position: relative;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        #overlay_pc .overlay_pc_content .cls_ov {
            color: #fff;
            text-align: center;
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 999999;
            font-size: 14px;
            padding: 4px 10px;
            border: 1px solid #aeaeae;
            background-color: rgba(0, 0, 0, 0.7);
        }

        #overlay_pc img {
            position: relative;
            z-index: 999;
        }

        @media only screen and (max-width: 768px) {
            #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
                width: 400px;
                top: 3%;
                transform: translate(-50%, 3%);
            }
        }

        @media only screen and (max-width: 400px) {
            #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
                width: 310px;
                top: 3%;
                transform: translate(-50%, 3%);
            }
        }
    </style>

    <style>
        .float-ck {
            position: fixed;
            bottom: 0px;
            z-index: 9
        }

        * html .float-ck

        /* IE6 position fixed Bottom */
            {
            position: absolute;
            bottom: auto;
            top: expression(eval (document.documentElement.scrollTop+document.docum entElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop, 10)||0)-(parseInt(this.currentStyle.marginBottom, 10)||0)));
        }

        #hide_float_left a {
            background: #0098D2;
            padding: 5px 15px 5px 15px;
            color: #FFF;
            font-weight: 700;
            float: left;
        }

        #hide_float_left_m a {
            background: #0098D2;
            padding: 5px 15px 5px 15px;
            color: #FFF;
            font-weight: 700;
        }

        span.bannermobi2 img {
            height: 70px;
            width: 300px;
        }

        #hide_float_right a {
            background: #01AEF0;
            padding: 5px 5px 1px 5px;
            color: #FFF;
            float: left;
        }
    </style>
</body>

</html>
