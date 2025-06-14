<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center">
                <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Hệ thống quản lý</h5>

                <div>
                    <button type="button"
                        class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="ph-arrows-left-right"></i>
                    </button>

                    <button type="button"
                        class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                        <i class="ph-x"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /sidebar header -->


        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header pt-0">
                    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide"></div>
                    <i class="ph-dots-three sidebar-resize-show"></i>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        style="display: flex; align-items: center;">
                        <i class="ph-house-simple me-3 fa"></i>
                        <span style="display: flex; align-items: center;">
                            Bảng điều khiền
                        </span>
                    </a>
                </li>
                <li class="nav-item-header">
                    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Câu lạc bộ</div>
                </li>

                    @if(Auth::user()->hasPermission('Quản lý câu lạc bộ'))
                        <li class="nav-item">
                            <a href="{{route('admin.club.index')}}"
                               class="nav-link {{ request()->routeIs('admin.club.index') ? 'active' : '' }}"
                               style="display: flex; align-items: center;">
                                <i class="ph-list-numbers me-3 fa"></i>
                                <span style="display: flex; align-items: center;">
                                    Danh sách CLB
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.request-club.list')}}"
                               class="nav-link {{ request()->routeIs('admin.request-club.list') ? 'active' : '' }}"
                               style="display: flex; align-items: center;">
                                <i class="ph-note-pencil me-3 fa"></i>
                                <span style="display: flex; align-items: center;">
                                    Danh sách đăng ký quản lý CLB
                                </span>
                            </a>
                        </li>
                    @endif
                    @if(Auth::user()->HasManagerClub())
                        <li class="nav-item">
                            <a href="{{route('admin.club.list-club')}}"
                               class="nav-link {{ request()->routeIs('admin.club.list-club') ? 'active' : '' }}"
                               style="display: flex; align-items: center;">
                                <i class="ph-list-checks  me-3 fa"></i>
                                <span style="display: flex; align-items: center;">
                                    Danh sách CLB bạn quản lý
                                </span>
                            </a>
                        </li>
                    @endif
                    @if(session('club_id') && (Auth::user()->hasPermissonClub('Quản lý chức vụ', session('club_id'))|| Auth::user()->hasPermissonClub('Quản lý thành viên', session('club_id')) || Auth::user()->hasPermissonClub('Tuyển thành viên', session('club_id'))))
                        <li class="nav-item-header">
                            <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide"> Thành viên </div>
                        </li>
                    @endif
                    @if(session('club_id') && Auth::user()->hasPermissonClub('Quản lý chức vụ', session('club_id')))
                        <li class="nav-item">
                            <a href="{{route('admin.club.role-index',['id'=>session('club_id')])}}"
                               class="nav-link {{ request()->routeIs('admin.club.role-index') ? 'active' : '' }}"
                               style="display: flex; align-items: center;">
                                <i class="fas fa-users-cog me-3 fa"></i>
                                <span style="display: flex; align-items: center;">
                                    Danh sách chức vụ trong CLB
                                </span>
                            </a>
                        </li>
                    @endif
                    @if(session('club_id') && Auth::user()->hasPermissonClub('Quản lý thành viên', session('club_id')))
                        <li class="nav-item">
                            <a href="{{route('admin.club.member-index',['id'=>session('club_id')])}}"
                               class="nav-link {{ request()->routeIs('admin.club.member-index') ? 'active' : '' }}"
                               style="display: flex; align-items: center;">
                                <i class="fas fa-users me-3 fa"></i>
                                <span style="display: flex; align-items: center;">
                                Danh sách thành viên CLB
                            </span>
                            </a>
                        </li>
                    @endif

                    @if(session('club_id') && Auth::user()->hasPermissonClub('Tuyển thành viên', session('club_id')))
                        <li class="nav-item">
                            <a href="{{route('admin.club.recruitment-member-index',['id'=>session('club_id')])}}"
                               class="nav-link {{ request()->routeIs('admin.club.recruitment-member-index') ? 'active' : '' }} {{request()->routeIs('admin.club.recruitment-member.list-request') ? 'active' : ''}}"
                               style="display: flex; align-items: center;">
                                <i class="ph-user-plus me-3 fa"></i>
                                <span style="display: flex; align-items: center;">
                                    Tuyển thành viên CLB
                                </span>
                            </a>
                        </li>
                    @endif
                    @if(session('club_id') && (Auth::user()->hasPermissonClub('Quản lý bài viết', session('club_id')) || Auth::user()->hasPermissonClub('Tạo bài viết mới', session('club_id'))))
                        <li class="nav-item-header">
                            <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Bài viết</div>
                        </li>
                    @endif
                    @if(session('club_id') && Auth::user()->hasPermissonClub('Quản lý bài viết', session('club_id')))
                        <li class="nav-item">
                            <a href="{{route('admin.club.category-post.index',['id'=>session('club_id')])}}"
                               class="nav-link {{ request()->routeIs('admin.club.category-post.index') ? 'active' : '' }}"
                               style="display: flex; align-items: center;">
                                <i class="ph-list-dashes me-3 fa"></i>
                                <span style="display: flex; align-items: center;">
                                            Danh mục bài viết
                                        </span>
                            </a>
                        </li>
                    @endif
                    @if(session('club_id') && Auth::user()->hasPermissonClub('Tạo bài viết mới', session('club_id')))
                        <li class="nav-item">
                            <a href="{{route('admin.club.post-index',['id'=>session('club_id')])}}"
                               class="nav-link {{ request()->routeIs('admin.club.role-index') ? 'active' : '' }}"
                               style="display: flex; align-items: center;">
                                <i class="ph-newspaper me-3 fa"></i>
                                <span style="display: flex; align-items: center;">
                                        Bài viết
                                    </span>
                            </a>
                        </li>
                    @endif

                    @if(session('club_id') && (Auth::user()->hasPermissonClub('Quản lý danh sách các sự kiện', session('club_id'))))
                        <li class="nav-item-header">
                            <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Sự kiện</div>
                        </li>
                    @endif
                    @if(session('club_id') && Auth::user()->hasPermissonClub('Quản lý danh sách các sự kiện', session('club_id')))
                        <li class="nav-item">
                            <a href="{{route('admin.club.event-index',['id'=>session('club_id')])}}"
                               class="nav-link {{ request()->routeIs('admin.club.event-index') ? 'active' : '' }}"
                               style="display: flex; align-items: center;">
                                <i class="ph-calendar-check me-3 fa"></i>
                                <span style="display: flex; align-items: center;">
                                                Danh sách các sự kiện
                                            </span>
                            </a>
                        </li>
                    @endif
                @if(session('club_id') && (Auth::user()->hasPermissonClub('Quản lý thông báo', session('club_id'))))
                    <li class="nav-item-header">
                        <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Thông báo</div>
                    </li>
                @endif
                @if(session('club_id') && Auth::user()->hasPermissonClub('Quản lý thông báo', session('club_id')))
                    <li class="nav-item">
                        <a href="{{route('admin.club.notification-index',['id'=>session('club_id')])}}"
                           class="nav-link {{ request()->routeIs('admin.club.notification-index') ? 'active' : '' }}"
                           style="display: flex; align-items: center;">
                            <i class="ph-bell-ringing me-3 fa"></i>
                            <span style="display: flex; align-items: center;">
                                                Quản lý thông báo
                                            </span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->
