{{--Start Header Area -->--}}
<header class="rainbow-header header-default header-left-align header-transparent header-sticky">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-9 col-md-6 col-2 position-static">
                <div class="header-left d-flex">
                    <div class="logo">
                        <a href="{{route('client.index')}}">
                            <img class="logo-light" src="{{asset('assets\admin\images\logo_vnua.png')}}" alt="Corporate Logo">
                            <img class="logo-dark" src="{{asset('assets\admin\images\logo_vnua.png')}}" alt="Corporate Logo">
                        </a>
                    </div>
                    <nav class="mainmenu-nav d-none d-lg-block">
                        <ul class="mainmenu">
                            <li><a href="{{route('client.index')}}">Trang chủ</a></li>
                            <li><a href="#">Hoạt động</a></li>
                            <li class="has-droupdown has-menu-child-item"><a href="#">Thông báo</a>
                                <livewire:client.header.notification/>
                            </li>
                            <li><a href="#">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-10">
                <div class="header-right">
                    <div class="side-wrap user-wrap">
                        <div class="acc-desk d-flex align-items-center">
                            <div class="user-icon">
                                <a href="@if(Auth()->check()) {{route('client.account',['item'=>1])}} @endif" class="user-icon-desk">
                                    <span><i class="me-3" style="width: 30px !important;height: 30px !important;" data-feather="user"></i></span>
                                </a>

                            </div>
                            <div class="user-info">
                                @if(Auth()->check())
{{--                                    <span class="fs-4 ps-3" style="font-weight: 600">{{session('userData.full_name')}}</span>--}}
                                    <span class="fs-4" style="font-weight: 600">{{Auth()->user()->full_name}}</span>
                                @else
                                    <span class="fs-4" style="font-weight: 600">Tài khoản</span>
                                @endif
                                <div class="account-login">
                                    @if(Auth()->check())
                                        @if(auth()->check() && auth()->user()->hasRole('officer'))
                                            <a class="pe-2" href="{{route('admin.dashboard')}}">Admin</a>
                                        @elseif(auth()->check() && Auth::user()->HasManagerClub() && session('club_id') != null)
                                            <a class="pe-2" href="{{route('admin.dashboard')}}">Quản lý CLB</a>
                                        @elseif(auth()->check() && Auth::user()->HasManagerClub() && session('club_id') == null)
                                            <a class="pe-2" href="{{route('admin.club.list-club')}}">Quản lý CLB</a>
                                        @endif

                                        <a class="pe-2" href="{{route('handelLogout')}}">Đăng xuất</a>
                                    @else
                                        <a href="{{route('sso.redirect')}}">Đăng nhập</a>
                                    @endif
                                </div>
                            </div>
                        </div>
{{--                        <div class="acc-mob">--}}
{{--                            <a href="" class="user-icon">--}}
{{--                                <span><i data-feather="user"></i></span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                    </div>

                    <!-- Start Mobile-Menu-Bar -->
                    <div class="mobile-menu-bar ml--5 d-block d-lg-none">
                        <div class="hamberger">
                            <button class="hamberger-button">
                                <i data-feather="menu"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Start Mobile-Menu-Bar -->

                    <!-- Start Switcher Area  -->
                    <div id="my_switcher" class="my_switcher">
                        <ul>
                            <li>
                                <a href="javascript: void(0);" data-theme="light" class="setColor light">
                                    <img class="sun-image" src="{{asset('assets/client/images/icons/sun-01.svg')}}" alt="Sun images">
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" data-theme="dark" class="setColor dark">
                                    <img class="Victor Image" src="{{asset('assets/client/images/icons/vector.svg')}}" alt="Vector Images">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Start Switcher Area  -->

                </div>
            </div>
        </div>
    </div>
</header>
{{--End Header Area -->--}}
<!-- Start Mobile Menu -->
<div class="popup-mobile-menu">
    <div class="inner">
        <div class="header-top">
            <div class="logo">
                <a href="">
                    <img class="logo-light" src="{{asset('assets\admin\images\logo_vnua.png')}}" alt="Corporate Logo">
                    <img class="logo-dark" src="{{asset('assets\admin\images\logo_vnua.png')}}" alt="Corporate Logo">
                </a>
            </div>
            <div class="close-menu">
                <button class="close-button">
                    <i data-feather="x"></i>
                </button>
            </div>
        </div>
        <ul class="mainmenu">
            <li><a href="{{route('client.index')}}">Trang chủ</a></li>
            <li><a href="">Hoạt động</a></li>
            <li><a href="">Thông báo</a></li>
            <li><a href="">Liên hệ</a></li>
        </ul>
    </div>
</div>
<!-- End Mobile Menu -->
