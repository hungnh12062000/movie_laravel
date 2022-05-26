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
                                    <span href="">Phim thuộc năm »</span>
                                    @for ($year_break = 2017; $year_break <= 2022; $year_break++)
                                        <span class="breadcrumb_last" aria-current="page"><a href="{{url('nam/'.$year_break)}}">{{$year_break}}</a></span> »
                                    @endfor
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section>
                <div class="section-bar clearfix">
                    <h1 class="section-title"><span>Năm: {{$year}}</span></h1>
                </div>
                <div class="halim_box">

                    @foreach ($movie as $key => $mov)
                        <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                            <div class="halim-item">
                                <a class="halim-thumb" href="{{route('movie', $mov->slug)}}">
                                    <figure><img class="lazy img-responsive"
                                            src="{{ asset('uploads/movie/' . $mov->image) }}" alt="{{ $mov->title }}"
                                            title="{{ $mov->title }}">
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
                                        @else
                                            Trailer
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
                <div class="clearfix"></div>

                {{-- Panigation --}}
                <div class="text-center">
                    {!! $movie->links('pagination::bootstrap-4') !!}
                </div>
            </section>
        </main>

        {{-- sidebar --}}
        @include('pages.include.sidebar')

    </div>
@endsection
