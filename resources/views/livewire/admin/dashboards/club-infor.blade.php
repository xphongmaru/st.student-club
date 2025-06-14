<div class="d-lg-flex align-items-lg-start">
    <!-- Left sidebar component -->
    <div class="sidebar sidebar-component sidebar-expand-lg bg-transparent shadow-none me-lg-3">

        <!-- Sidebar content -->
        <div class="sidebar-content">

            <!-- Navigation -->
            <div class="card">
                <div class="sidebar-section-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img class="img-fluid rounded-circle" src="{{asset('storage/'.$club->thumbnail)}}" width="150" height="150" alt="" style="object-fit: cover; width: 150px; height: 150px">
                        <div class="card-img-actions-overlay card-img rounded-circle">
                            <a href="{{route('client.page-club', ['id'=>$club->id])}}" class="btn btn-outline-white btn-icon rounded-pill">
                                <i class="ph-eye"></i>
                            </a>
                        </div>
                    </div>

                    <h6 class="mb-0">{{$club->name}}</h6>
                    <span class="text-muted">Chủ tịch: {{$club->getUser($club->owner_id)->full_name}}</span>
                </div>

                <ul class="nav nav-sidebar">
                    <li class="nav-item">
                        <a href="#profile" class="nav-link active" data-bs-toggle="tab">
                            <i class="ph-user me-2"></i>
                            Thông tin CLB
                        </a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a href="#schedule" class="nav-link" data-bs-toggle="tab">--}}
{{--                            <i class="ph-calendar me-2"></i>--}}
{{--                            Schedule--}}
{{--                            <span class="fs-sm fw-normal text-muted ms-auto">02:56pm</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="#inbox" class="nav-link" data-bs-toggle="tab">--}}
{{--                            <i class="ph-envelope me-2"></i>--}}
{{--                            Inbox--}}
{{--                            <span class="badge bg-secondary rounded-pill ms-auto">29</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="#orders" class="nav-link" data-bs-toggle="tab">--}}
{{--                            <i class="ph-shopping-cart me-2"></i>--}}
{{--                            Orders--}}
{{--                            <span class="badge bg-secondary rounded-pill ms-auto">16</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li class="nav-item-divider"></li>
                    <li class="nav-item">
                        <button wire:click="logoutClub" class="nav-link" data-bs-toggle="tab" style="border: none; width: 100%;">
                            <i class="ph-sign-out me-2"></i>
                            Đăng xuất quản lý CLB
                        </button>
                    </li>
                </ul>
            </div>
            <!-- /navigation -->
        </div>
        <!-- /sidebar content -->
    </div>
    <!-- /left sidebar component -->
    <!-- Right content -->
    <div class="tab-content flex-fill">
        <div class="tab-pane fade active show" id="profile">

            <!-- Sales stats -->
            <div class="card">
                <div class="card-header d-sm-flex">
                    <h5 class="mb-0">Thông tin câu lạc bộ</h5>
                    <div class="mt-2 mt-sm-0 ms-auto">
{{--                        <span>--}}
{{--                            <i class="ph-clock-counter-clockwise me-1"></i>--}}
{{--                            Cập nhật lần cuối: <span class="fw-semibold">12:30 PM</span>--}}
{{--                        </span>--}}
                    </div>
                </div>

                <div class="card-body">
                    <div class="chart-container">
                        <div class="chart" id="tornado_negative_stack">
                            <div class="row">
                                <div class="col-sm-6 col-xl-4">
                                    <div class="card card-body">
                                        <div class="d-flex align-items-center">
                                            <i class="ph-users-three ph-2x text-indigo me-3"></i>

                                            <div class="flex-fill text-end">
                                                <h4 class="mb-0">{{$club->members_count}}</h4>
                                                <span class="text-muted">Thành viên </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-4">
                                    <div class="card card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-fill">
                                                <h4 class="mb-0">{{$club->posts_count}}</h4>
                                                <span class="text-muted">Bài viết</span>
                                            </div>

                                            <i class="ph-chats ph-2x text-primary ms-3"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-xl-4">
                                    <div class="card card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-fill">
                                                <h4 class="mb-0">{{$club->events_count}}</h4>
                                                <span class="text-muted">Sự kiện</span>
                                            </div>

                                            <i class="ph-package ph-2x text-danger ms-3"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

{{--                            <div class="row">--}}
{{--                                <div class="col-sm-6 col-xl-3">--}}
{{--                                    <div class="card card-body bg-primary text-white">--}}
{{--                                        <div class="d-flex align-items-center">--}}
{{--                                            <div class="flex-fill">--}}
{{--                                                <h4 class="mb-0">54,390</h4>--}}
{{--                                                total comments--}}
{{--                                            </div>--}}

{{--                                            <i class="ph-chats ph-2x opacity-75 ms-3"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-sm-6 col-xl-3">--}}
{{--                                    <div class="card card-body bg-danger text-white">--}}
{{--                                        <div class="d-flex align-items-center">--}}
{{--                                            <div class="flex-fill">--}}
{{--                                                <h4 class="mb-0">389,438</h4>--}}
{{--                                                total orders--}}
{{--                                            </div>--}}

{{--                                            <i class="ph-package ph-2x opacity-75 ms-3"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-sm-6 col-xl-3">--}}
{{--                                    <div class="card card-body bg-success text-white">--}}
{{--                                        <div class="d-flex align-items-center">--}}
{{--                                            <i class="ph-hand-pointing ph-2x opacity-75 me-3"></i>--}}

{{--                                            <div class="flex-fill text-end">--}}
{{--                                                <h4 class="mb-0">652,549</h4>--}}
{{--                                                total clicks--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-sm-6 col-xl-3">--}}
{{--                                    <div class="card card-body bg-indigo text-white">--}}
{{--                                        <div class="d-flex align-items-center">--}}
{{--                                            <i class="ph-users-three ph-2x opacity-75 me-3"></i>--}}

{{--                                            <div class="flex-fill text-end">--}}
{{--                                                <h4 class="mb-0">245,382</h4>--}}
{{--                                                total visits--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /sales stats -->


        </div>
    </div>
    <!-- /right content -->
</div>
