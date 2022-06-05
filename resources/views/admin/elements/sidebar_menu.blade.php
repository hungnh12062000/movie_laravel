<!-- menu profile quick info -->
<div class="profile clearfix">
    @if (Auth::id())
        <div class="profile_pic">
            <img src="{{ asset('admin/img/img.jpg') }}" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span>Welcome,</span>
            <h2>{{ Auth::user()->name }}</h2>
        </div>
    @endif
</div>
<!-- /menu profile quick info -->
<br />

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        @if (Auth::id())
            <h3>Menu</h3>
            <ul class="nav side-menu">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="{{ route('category.index') }}"><i class="fa-solid fa-align-justify"
                            style="font-size: 20px;"></i> Category</a></li>
                <li><a href="{{ route('country.index') }}"><i class="fas fa-globe-asia" style="font-size: 20px;"></i>
                        Country</a></li>
                <li><a href="{{ route('genre.index') }}"><i class="fa-solid fa-mars-and-venus"
                            style="font-size: 20px;"></i> Genre</a></li>
                <li><a href="{{ route('episode.index') }}"><i class="fa-solid fa-clapperboard"
                            style="font-size: 20px;"></i> Episode</a></li>
                <li><a href="{{ route('movie.index') }}"><i class="fa-solid fa-film" style="font-size: 20px;"></i>
                        Movie</a></li>
                <li><a href="{{ route('slider') }}"><i class="fa fa-sliders"></i> Silders</a></li>
                <li><a href="{{ route('homepage') }}"><i class="fa fa-home"></i> Về trang chủ</a></li>
            </ul>
        @endif
    </div>
</div>
<!-- /sidebar menu -->
