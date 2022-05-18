    {{-- start sidebar phim hot --}}
    <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
        <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
            <div class="section-bar clearfix">
                <div class="section-title">
                    <span>Phim hot</span>
                </div>
            </div>
            <section class="tab-content">
                <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                    <div class="halim-ajax-popular-post-loading hidden"></div>
                    <div id="halim-ajax-popular-post" class="popular-post">
                        @foreach ($movie_hot_sidebar as $key => $mov_sidebar)
                            <div class="item post-37176">
                                <a href="{{ route('movie', $mov_sidebar->slug) }}"
                                    title="{{ $mov_sidebar->title }}">
                                    <div class="item-link">
                                        <img src="{{ asset('uploads/movie/' . $mov_sidebar->image) }}"
                                            class="lazy post-thumb" alt="{{ $mov_sidebar->title }}"
                                            title="{{ $mov_sidebar->title }}" />
                                        <span class="is_trailer">
                                            @if ($mov_sidebar->resolution == 0)
                                                HD
                                            @elseif ($mov_sidebar->resolution == 1)
                                                SD
                                            @elseif ($mov_sidebar->resolution == 2)
                                                HDCam
                                            @elseif ($mov_sidebar->resolution == 3)
                                                Cam
                                            @elseif ($mov_sidebar->resolution == 4)
                                                FULLHD
                                            @else
                                                Trailer
                                            @endif
                                        </span>
                                    </div>
                                    <p class="title">{{ $mov_sidebar->title }}</p>
                                </a>
                                <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                                <div style="float: left;">
                                    <span class="user-rate-image post-large-rate stars-large-vang"
                                        style="display: block;/* width: 100%; */">
                                        <span style="width: 0%"></span>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <div class="clearfix"></div>

            <div class="section-bar clearfix">
                <div class="section-title">
                    <span>Phim sắp chiếu</span>
                </div>
            </div>
            <section class="tab-content">
                <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                    <div class="halim-ajax-popular-post-loading hidden"></div>
                    <div id="halim-ajax-popular-post" class="popular-post">
                        @foreach ($movie_hot_trailer as $key => $mov_sidebar)
                            <div class="item post-37176">
                                <a href="{{ route('movie', $mov_sidebar->slug) }}"
                                    title="{{ $mov_sidebar->title }}">
                                    <div class="item-link">
                                        <img src="{{ asset('uploads/movie/' . $mov_sidebar->image) }}"
                                            class="lazy post-thumb" alt="{{ $mov_sidebar->title }}"
                                            title="{{ $mov_sidebar->title }}" />
                                        <span class="is_trailer">
                                            @if ($mov_sidebar->resolution == 0)
                                                HD
                                            @elseif ($mov_sidebar->resolution == 1)
                                                SD
                                            @elseif ($mov_sidebar->resolution == 2)
                                                HDCam
                                            @elseif ($mov_sidebar->resolution == 3)
                                                Cam
                                            @elseif ($mov_sidebar->resolution == 4)
                                                FULLHD
                                            @else
                                                Trailer
                                            @endif
                                        </span>
                                    </div>
                                    <p class="title">{{ $mov_sidebar->title }}</p>
                                </a>
                                <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                                <div style="float: left;">
                                    <span class="user-rate-image post-large-rate stars-large-vang"
                                        style="display: block;/* width: 100%; */">
                                        <span style="width: 0%"></span>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <div class="clearfix"></div>

            {{-- <div class="section-bar clearfix">
                <div class="section-title">
                    <span>Top Views</span>
                </div>
            </div>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link active filter-sidebar show_default" id="pills-home-tab" data-toggle="pill" href="#day" role="tab"
                        aria-controls="pills-home" aria-selected="true">Ngày</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link filter-sidebar" id="pills-profile-tab" data-toggle="pill" href="#week" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Tuần</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link filter-sidebar" id="pills-contact-tab" data-toggle="pill" href="#month"
                        role="tab" aria-controls="pills-contact" aria-selected="false">Tháng</a>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade" id="day" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div id="halim-ajax-popular-post" class="popular-post">

                        <div class="item post-37176">
                            <a href="chitiet.php" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
                                <div class="item-link">
                                    <img src="#" class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ"
                                        title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                                    <span class="is_trailer">Trailer</span>
                                </div>
                                <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>
                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                            <div style="float: left;">
                                <span class="user-rate-image post-large-rate stars-large-vang"
                                    style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                </span>
                            </div>
                        </div>
                        <span id="show0"></span>
                    </div>
                </div>
                <div class="tab-pane fade" id="week" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div id="halim-ajax-popular-post" class="popular-post">
                        <span id="show1"></span>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="month" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div id="halim-ajax-popular-post" class="popular-post">
                        <span id="show2"></span>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div> --}}
        </div>
    </aside>

    {{-- end sidebar --}}
