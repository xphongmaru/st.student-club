<!-- Main navbar -->
<div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
    <div class="container-fluid">
        <div class="d-flex d-lg-none me-2">
            <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
                <i class="ph-list"></i>
            </button>
        </div>

        <div class="navbar-brand flex-1 flex-lg-0" style="flex-grow: 1; max-width: 250px;">
            <img src="{{asset('assets/admin/images/logo-vnua-white.png')}}" alt="" style="width: 100%; height: auto;">
        </div>
        <ul class="nav flex-row justify-content-end order-1 order-lg-2">

            @if(session('club_id'))
                <li class="nav-item ms-lg-2 bg-success" style="border-radius: 30px">
                    <livewire:admin.header.name-club-manager></livewire:admin.header.name-club-manager>
                </li>
            @else
                <li class="nav-item ms-lg-2 bg-success" style="border-radius: 30px">
                    <a href="{{ route('client.index') }}" class="navbar-nav-link rounded-pill d-flex align-items-center">
                        <i class="ph-house me-2"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>
            @endif

            <li class="nav-item ms-lg-2">
                <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded-pill" data-bs-toggle="offcanvas" data-bs-target="#notifications">
                    <i class="ph-bell"></i>
                    <span class="badge bg-yellow text-black position-absolute top-0 end-0 translate-middle-top zindex-1 rounded-pill mt-1 me-1">2</span>
                </a>
            </li>

            <li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
                <a href="#" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
                    <div class="status-indicator-container">
                        <img src="{{ asset('assets/admin/images/logoST.jpg') }}" class="w-32px h-32px rounded-pill" alt="">
                        <span class="status-indicator bg-success"></span>
                    </div>
{{--                    <span class="d-none d-lg-inline-block mx-lg-2">{{ auth()->user()->name }}</span>--}}
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <a href="#" class="dropdown-item">
                        <i class="ph-user-circle me-2"></i>
                        Thông tin cá nhân
                    </a>
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <i class="ph-currency-circle-dollar me-2"></i>--}}
{{--                        My subscription--}}
{{--                    </a>--}}
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <i class="ph-shopping-cart me-2"></i>--}}
{{--                        My orders--}}
{{--                    </a>--}}
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <i class="ph-envelope-open me-2"></i>--}}
{{--                        My inbox--}}
{{--                        <span class="badge bg-primary rounded-pill ms-auto">26</span>--}}
{{--                    </a>--}}
                    <div class="dropdown-divider"></div>
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <i class="ph-gear me-2"></i>--}}
{{--                        Account settings--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('logout') }}" class="dropdown-item">--}}
{{--                        <i class="ph-sign-out me-2"></i>--}}
{{--                        Đăng xuất--}}
{{--                    </a>--}}
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->
