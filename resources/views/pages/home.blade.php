@extends('layout')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>

        <div id="halim_related_movies-2xx" class="wrap-slider">
            <div class="section-bar clearfix">
                <h3 class="section-title"><span>PHIM HOT</span></h3>
            </div>
            <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                @foreach ($movie_hot as $key => $mov_hot)
                    <article class="thumb grid-item post-38498">
                        <div class="halim-item">
                            <a class="halim-thumb" href="{{ route('movie', $mov_hot->slug) }}" title="{{ $mov_hot->title }}">
                                <figure><img class="lazy img-responsive" src="{{ asset('uploads/movie/' . $mov_hot->image) }}"
                                        alt="Đại Thánh Vô Song" title="Đại Thánh Vô Song"></figure>
                                <span class="status">
                                    @if ($mov_hot->resolution == 0)
                                        HD
                                    @elseif ($mov_hot->resolution == 1)
                                        SD
                                    @elseif ($mov_hot->resolution == 2)
                                        HDCam
                                    @elseif ($mov_hot->resolution == 3)
                                        Cam
                                    @elseif ($mov_hot->resolution == 4)
                                        FULLHD
                                    @else
                                        Trailer
                                    @endif
                                </span><span class="episode"><i class="fa fa-play"
                                        aria-hidden="true"></i>
                                        @if ($mov_hot->cc == 0)
                                            Phụ đề
                                        @elseif ($mov_hot->cc == 1)
                                            Thuyết minh
                                        @endif
                                </span>
                                <div class="icon_overlay"></div>
                                <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                        <p class="entry-title">{{ $mov_hot->title }}</p>
                                        <p class="original_title">{{ $mov_hot->name_eng }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>

        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            @foreach ($category_home as $key => $cate_home)
                {{-- loop 3 category --}}
                <section id="halim-advanced-widget-2">
                    <div class="section-heading">
                        <a href="danhmuc.php" title="{{ $cate_home->title }}">
                            <span class="h-text">{{ $cate_home->title }}</span>
                        </a>
                    </div>
                    <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                        @foreach ($cate_home->movie->take(8) as $key => $mov)
                            {{-- movie trong category --}}
                            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="{{route('movie', $mov->slug)}}">
                                        <figure><img class="lazy img-responsive"
                                                src="{{ asset('uploads/movie/' . $mov->image) }}"
                                                alt="{{ $mov->title }}" title="{{ $mov->title }}">
                                        </figure>
                                        <span class="status">
                                            @if ($mov->resolution == 0)
                                                HD
                                            @elseif ($mov->resolution == 1)
                                                SD
                                            @elseif ($mov->resolution == 2)
                                                HDCam
                                            @elseif ($mov->resolution == 3)
                                                Cam
                                            @elseif ($mov->resolution == 4)
                                                FULLHD
                                            @endif
                                        </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                            @if ($mov->cc == 0)
                                                Phụ đề
                                            @elseif ($mov->cc == 1)
                                                Thuyết minh
                                            @endif
                                        </span>
                                        <div class="icon_overlay"></div>
                                        <div class="halim-post-title-box">
                                            <div class="halim-post-title ">
                                                <p class="entry-title">{{ $mov->title }}</p>
                                                <p class="original_title">{{ $mov->name_eng }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                        @endforeach

                    </div>
                </section>
                <div class="clearfix"></div>
            @endforeach
        </main>
        {{-- sidebar  --}}
        @include('pages.include.sidebar')
    </div>
@endsection
