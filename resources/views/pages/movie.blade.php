@extends('layout')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs">
                            <span>
                                <span>
                                    <a
                                        href="{{ route('category', $movie->category->slug) }}">{{ $movie->category->title }}</a>
                                    » <span>
                                        <a
                                            href="{{ route('country', $movie->country->slug) }}">{{ $movie->country->title }}</a>
                                        » <span class="breadcrumb_last"
                                            aria-current="page">{{ $movie->title }}</span></span></span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section id="content" class="test">
                <div class="clearfix wrap-content">

                    <div class="halim-movie-wrapper">
                        <div class="title-block">
                            <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                                <div class="halim-pulse-ring"></div>
                            </div>
                            <div class="title-wrapper" style="font-weight: bold;">
                                Bookmark
                            </div>
                        </div>
                        <div class="movie_info col-xs-12">

                            <div class="movie-poster col-md-3">
                                <img class="movie-thumb" src="{{ asset('uploads/movie/' . $movie->image) }}"
                                    alt="{{ $movie->title }}">

                                @if ($movie->resolution != 5)
                                    <div class="bwa-content">
                                        <div class="loader"></div>
                                        <a href="{{ route('watch') }}" class="bwac-btn">
                                            <i class="fa fa-play"></i>
                                        </a>
                                    </div>
                                @else
                                    <a href="#trailer_movie" style="display: block;" class="btn btn-primary">Xem trailer</a>
                                @endif
                            </div>

                            <div class="film-poster col-md-9">
                                <h1 class="movie-title title-1"
                                    style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">
                                    {{ $movie->title }}</h1>
                                <h2 class="movie-title title-2" style="font-size: 12px;">{{ $movie->name_eng }}</h2>
                                <ul class="list-info-group">
                                    <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">
                                            @if ($movie->resolution == 0)
                                                HD
                                            @elseif ($movie->resolution == 1)
                                                SD
                                            @elseif ($movie->resolution == 2)
                                                HDCam
                                            @elseif ($movie->resolution == 3)
                                                Cam
                                            @elseif ($movie->resolution == 4)
                                                FULLHD
                                            @else
                                                Trailer
                                            @endif
                                        </span>
                                        @if ($movie->resolution != 5)
                                            <span class="episode">
                                                @if ($movie->cc == 0)
                                                    Phụ đề
                                                @elseif ($movie->cc == 1)
                                                    Thuyết minh
                                                @endif
                                            </span>
                                        @endif
                                    </li>
                                    {{-- <li class="list-info-group-item"><span>Điểm IMDb</span> : <span class="imdb">7.2</span></li> --}}
                                    <li class="list-info-group-item"><span>Thời lượng</span> : {{ $movie->time }}</li>
                                    <li class="list-info-group-item"><span>Thể loại</span> :
                                        @foreach ($movie->movie_genre as $gen )
                                            <a href="{{ route('genre', $gen->slug) }}" rel="genre tag">{{$gen->title}}</a>
                                        @endforeach
                                    </li>
                                    <li class="list-info-group-item"><span>Danh mục</span> :
                                        <a href="{{ route('category', $movie->category->slug) }}"
                                            rel="category tag">{{ $movie->category->title }}</a>
                                    </li>
                                    <li class="list-info-group-item"><span>Quốc gia</span> :
                                        <a href="{{ route('country', $movie->country->slug) }}"
                                            rel="country tag">{{ $movie->country->title }}</a>
                                    </li>
                                    {{-- <li class="list-info-group-item"><span>Đạo diễn</span> : <a class="director"
                                            rel="nofollow" href="https://phimhay.co/dao-dien/cate-shortland"
                                            title="Cate Shortland">Cate Shortland</a></li>
                                    <li class="list-info-group-item last-item"
                                        style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;">
                                        <span>Diễn viên</span> : <a href="" rel="nofollow" title="C.C. Smiff">C.C.
                                            Smiff</a>, <a href="" rel="nofollow" title="David Harbour">David Harbour</a>, <a
                                            href="" rel="nofollow" title="Erin Jameson">Erin Jameson</a>, <a href=""
                                            rel="nofollow" title="Ever Anderson">Ever Anderson</a>, <a href=""
                                            rel="nofollow" title="Florence Pugh">Florence Pugh</a>, <a href=""
                                            rel="nofollow" title="Lewis Young">Lewis Young</a>, <a href="" rel="nofollow"
                                            title="Liani Samuel">Liani Samuel</a>, <a href="" rel="nofollow"
                                            title="Michelle Lee">Michelle Lee</a>, <a href="" rel="nofollow"
                                            title="Nanna Blondell">Nanna Blondell</a>, <a href="" rel="nofollow"
                                            title="O-T Fagbenle">O-T Fagbenle</a>
                                    </li> --}}
                                </ul>
                                <div class="movie-trailer hidden"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="halim_trailer"></div>
                    <div class="clearfix"></div>

                    {{-- Nội dung phim --}}
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content" style="text-align: justify;">
                                {{ $movie->description }}
                            </article>
                        </div>
                    </div>
                    {{-- Nội dung phim end --}}

                    {{-- Từ khóa --}}
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Từ khóa</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                @if ($movie->tags != null)
                                    @php
                                        $tags = [];
                                        $tags = explode(',', $movie->tags);
                                        // print_r($tags);
                                    @endphp
                                    @foreach ($tags as $key => $tag)
                                        <a href="{{ url('tag/' . $tag) }}">{{ $tag }}</a>
                                    @endforeach
                                @endif
                            </article>
                        </div>
                    </div>
                    {{-- Từ khóa end --}}

                    {{-- trailer --}}
                    @if ($movie->trailer)
                        <div class="section-bar clearfix" id="trailer_movie">
                            <h2 class="section-title"><span style="color:#ffed4d">Trailer phim</span></h2>
                        </div>
                        <div class="entry-content htmlwrap clearfix">
                            <div class="video-item halim-entry-box">
                                <article id="post-38424" class="item-content">
                                    <iframe width="100%" height="400"
                                        src="https://www.youtube.com/embed/{{ $movie->trailer }}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </article>
                            </div>
                        </div>
                    @endif
                    {{-- trailer end --}}

                    {{-- Bình luận --}}
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        @php
                            $current_url = Request::url(); //get url current page
                        @endphp
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content fb-background-color">
                                <div class="fb-comments" data-href="{{ $current_url }}" data-width="100%"
                                    data-numposts="10"></div>
                            </article>
                        </div>
                    </div>
                    {{-- Bình luận end --}}


                </div>
            </section>

            {{-- movie related start --}}
            <section class="related-movies">
                <div id="halim_related_movies-2xx" class="wrap-slider">
                    <div class="section-bar clearfix">
                        <h3 class="section-title"><span>CÓ THỂ BẠN CŨNG MUỐN XEM</span></h3>
                    </div>
                    <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">

                        @foreach ($movie_related as $key => $mov_related)
                            <article class="thumb grid-item post-38498">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="{{ route('movie', $mov_related->slug) }}"
                                        title="{{ $mov_related->title }}">

                                        <figure><img class="lazy img-responsive"
                                                src="{{ asset('uploads/movie/' . $mov_related->image) }}"
                                                alt="{{ $mov_related->title }}" title="{{ $mov_related->title }}">
                                        </figure>

                                        <span class="status">
                                            @if ($mov_related->resolution == 0)
                                                HD
                                            @elseif ($mov_related->resolution == 1)
                                                SD
                                            @elseif ($mov_related->resolution == 2)
                                                HDCam
                                            @elseif ($mov_related->resolution == 3)
                                                Cam
                                            @elseif ($mov_related->resolution == 4)
                                                FULLHD
                                            @else
                                                Trailer
                                            @endif
                                        </span>

                                        @if ($mov_related->resolution != 5)
                                            <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                                @if ($mov_related->cc == 0)
                                                    Phụ đề
                                                @elseif ($mov_related->cc == 1)
                                                    Thuyết minh
                                                @endif
                                            </span>
                                        @endif

                                        <div class="icon_overlay"></div>
                                        <div class="halim-post-title-box">
                                            <div class="halim-post-title ">
                                                <p class="entry-title">{{ $mov_related->title }}</p>
                                                <p class="original_title">{{ $mov_related->name_eng }}</p>
                                            </div>
                                        </div>

                                    </a>
                                </div>
                            </article>
                        @endforeach

                    </div>
                    <script>
                        jQuery(document).ready(function($) {
                            var owl = $('#halim_related_movies-2');
                            owl.owlCarousel({
                                loop: true,
                                margin: 4,
                                autoplay: true,
                                autoplayTimeout: 4000,
                                autoplayHoverPause: true,
                                nav: true,
                                navText: ['<i class="hl-down-open rotate-left"></i>',
                                    '<i class="hl-down-open rotate-right"></i>'
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
                                        items: 4
                                    }
                                }
                            })
                        });
                    </script>
                </div>
            </section>
            {{-- movie related end --}}

        </main>
        {{-- sidebar --}}
        @include('pages.include.sidebar')
    </div>
@endsection
