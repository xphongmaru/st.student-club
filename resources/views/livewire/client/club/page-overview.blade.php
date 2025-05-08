<div class="row g-5 service-wrapper">
    <!-- Start Single Service  -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 sal-animate club">
        <div class="service service__style--1 bg-color-blackest radius text-center rbt-border">
            <div class="icon">
                <i data-feather="users"></i>
            </div>
            <div class="content">
                <h4 class="title w-600">{{$club->members_count}}</h4>
                <p class="description b1 mb--0">Thành viên</p>
            </div>
        </div>
    </div>
    <!-- End Single Service  -->
    <!-- Start Single Service  -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 sal-animate club">
        <div class="service service__style--1 bg-color-blackest radius text-center rbt-border">
            <div class="icon">
                <i data-feather="calendar"></i>
            </div>
            <div class="content">
                @php
                    use Carbon\Carbon;
                @endphp
                <h4 class="title w-600">{{ $club->foundation_date ? '>'.$years . ' năm' : '<1 năm' }}</h4>
                <p class="description b1 mb--0">Năm hoạt động</p>
            </div>
        </div>
    </div>
    <!-- End Single Service  -->
    <!-- Start Single Service  -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 sal-animate club">
        <div class="service service__style--1 bg-color-blackest radius text-center rbt-border">
            <div class="icon">
                <i data-feather="edit"></i>
            </div>
            <div class="content">
                <h4 class="title w-600">{{$club->posts_count}}</h4>
                <p class="description b1 mb--0">Bài viết</p>
            </div>
        </div>
    </div>
    <!-- End Single Service  -->
    <!-- Start Single Service  -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12 sal-animate club">
        <div class="service service__style--1 bg-color-blackest radius text-center rbt-border">
            <div class="icon">
                <i data-feather="folder"></i>
            </div>
            <div class="content">
                <h4 class="title w-600">{{$club->events_count}}</h4>
                <p class="description b1 mb--0">Sự kiện</p>
            </div>
        </div>
    </div>
    <!-- End Single Service  -->
</div>
