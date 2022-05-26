<div class="nav_menu">
    <nav>
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle user-profile" href="javascript:;" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img src="{{ asset('admin/img/img.jpg') }}" alt="">{{ Auth::user()->name }}
                        <span class=" fa fa-angle-down"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-usermenu pull-right"
                        aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out pull-right"></i>
                                Đăng xuất
                            </a></li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            @endguest
        </ul>
    </nav>
</div>
