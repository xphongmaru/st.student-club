@extends('client.layouts.master')
@section('title')
    Câu lạc bộ
@endsection

@section('content')
    <!-- Start Breadcarumb area  -->
    <div class="breadcrumb-area breadcarumb-style-1" style="height: 100px; margin-top: 80px; background-image: url({{asset('assets/client/images/bg/breadcarumb.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner ms-3">
{{--                        <h1 class="title theme-gradient h2">Blog List View.</h1>--}}
                        <ul class="page-list">
                            <li class="rainbow-breadcrumb-item"><a href="/">Home</a></li>
                            <li class="rainbow-breadcrumb-item"><a href="">Câu lạc bộ</a></li>
                            <li class="rainbow-breadcrumb-item active">{{$club->name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcarumb area  -->

    <!-- Start Main Counter up-5 Area  -->
    <div class="rainbow-counterup-area mt-5">
        <div class="container">
            <livewire:client.club.page-infor-name :club_id="$club->id" />
        </div>
    </div>
    <!-- End Main Counter up-5 Area  -->

    <!-- Start Service-8 Area  -->
    <div class="rainbow-service-area rainbow-section-gap " style="padding: 40px 0 !important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title" data-sal="slide-up" data-sal-duration="700" data-sal-delay="100">
                        <h4 class="title w-600 mb--20" style="font-size: 20px">Giới thiệu tổng quan về câu lạc bộ: </h4>
                    </div>
                </div>
            </div>
            <!-- Start Feature Service  -->
            <div>
                <livewire:client.club.page-overview :club="$club" />
            </div>
            <!-- End Feature Service  -->
        </div>
    </div>
    <!-- End Service-8 Area  -->

    <!-- Start Service-8 Area  -->
    <div class="rainbow-service-area rainbow-section-gap pb--20" style="padding-top: 40px !important;">
        <div class="container">
            <!-- Start Feature Service  -->
            <div class="row g-5 service-infor">
                <!-- Start Single Service  -->
                <livewire:client.club.page-description :club="$club"/>
                <!-- End Single Service  -->
            </div>
            <!-- End Feature Service  -->
        </div>
    </div>
    <!-- End Service-8 Area  -->

    <!-- Start Blog List View  -->
    <div class="main-content">
        <div class="rainbow-blog-area rainbow-section-gap pt--50 pb--40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center" data-sal="slide-up" data-sal-duration="700" data-sal-delay="100">
                            <h2 class="title w-600 mb--20">Bài viết câu lạc bộ </h2>
                        </div>
                    </div>
                </div>
                <div class="row mt_dec--30">
                    <div class="col-lg-12">
                        <div class="row row--15">
                            <div class="col-lg-6 mt--30">
                                <div class="rainbow-card box-card-style-default card-list-view">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a class="image" href="#">
                                                <img src="{{asset('assets/client/images/clb/clb-01.jpg')}}" alt="Blog Image">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">
                                                <a href="#">Tiêu đề bài viết</a>
                                            </h4>
                                            <ul class="rainbow-meta-list">
                                                <li><a href="#">Name</a></li>
                                                <li class="separator">/</li>
                                                <li>10 Dec 2021</li>
                                            </ul>
                                            <div style="width: 100%">
                                                <span class="descriptiion">Mô tả ngắn nội dung bài viết.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mt--30">
                                <div class="rainbow-card box-card-style-default card-list-view">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a class="image" href="#">
                                                <img src="{{asset('assets/client/images/clb/clb-01.jpg')}}" alt="Blog Image">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">
                                                <a href="#">Tiêu đề bài viết</a>
                                            </h4>
                                            <ul class="rainbow-meta-list">
                                                <li><a href="#">Name</a></li>
                                                <li class="separator">/</li>
                                                <li>10 Dec 2021</li>
                                            </ul>
                                            <div style="width: 100%">
                                                <span class="descriptiion">Mô tả ngắn nội dung bài viết. Mô tả ngắn nội dung bài viết. Mô tả ngắn nội dung bài viết. Mô tả ngắn nội dung bài viết. Mô tả ngắn nội dung bài viết.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mt--30">
                                <div class="rainbow-card box-card-style-default card-list-view">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a class="image" href="#">
                                                <img src="{{asset('assets/client/images/clb/clb-01.jpg')}}" alt="Blog Image">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">
                                                <a href="#">Tiêu đề bài viết</a>
                                            </h4>
                                            <ul class="rainbow-meta-list">
                                                <li><a href="#">Name</a></li>
                                                <li class="separator">/</li>
                                                <li>10 Dec 2021</li>
                                            </ul>
                                            <div style="width: 100%">
                                                <span class="descriptiion">Mô tả ngắn nội dung bài viết. Mô tả ngắn nội dung bài viết. Mô tả ngắn nội dung bài viết. Mô tả ngắn nội dung bài viết. Mô tả ngắn nội dung bài viết.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mt--30">
                                <div class="rainbow-card box-card-style-default card-list-view">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a class="image" href="#">
                                                <img src="{{asset('assets/client/images/clb/clb-01.jpg')}}" alt="Blog Image">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h4 class="title">
                                                <a href="#">Tiêu đề bài viết</a>
                                            </h4>
                                            <ul class="rainbow-meta-list">
                                                <li><a href="#">Name</a></li>
                                                <li class="separator">/</li>
                                                <li>10 Dec 2021</li>
                                            </ul>
                                            <div style="width: 100%">
                                                <span class="descriptiion">Mô tả ngắn nội dung bài viết. Mô tả ngắn nội dung bài viết. Mô tả ngắn nội dung bài viết. Mô tả ngắn nội dung bài viết. Mô tả ngắn nội dung bài viết.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="rainbow-load-more text-center mt--40">
                            <button class="btn btn-default btn-icon round">
                                <span>Xem thêm
                                    <span class="icon">
                                        <i data-feather="arrow-right"></i>
                                        </span>
                                    </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog List View  -->

    <div class="main-content">
        <div class="rainbow-blog-area rainbow-section-gap pt--20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center" data-sal="slide-up" data-sal-duration="700" data-sal-delay="100">
                            <h2 class="title w-600 mb--20">Các hoạt động của câu lạc bộ</h2>
                        </div>
                    </div>
                </div>
                <div id="owl-demo" class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="cmt--30" data-sal="slide-up" data-sal-duration="700">
                            <div class="rainbow-card box-card-style-default">
                                <div class="inner">
                                    <div class="thumbnail"><a class="image" href="#"><img src="{{asset('assets/client/images/clb/clb-01.jpg')}}" alt="Blog Image"></a></div>
                                    <div class="content pt--0">
                                        <h4 class="title mb--5"><a href="#">CLB học tập C/C++</a>
                                        </h4>
                                        <ul class="rainbow-meta-list">
                                            <li>Là nơi gặp gỡ, chia sẻ và học hỏi giữa các thành viên với nhau cũng như với các CLB, tổ chức bạn. Chúng tôi tạo ra một môi trường mở – nơi mọi ý tưởng đều được lắng nghe, mọi cá tính đều được tôn trọng, và mọi người đều có cơ hội thể hiện bản thân.</li>
                                        </ul>
                                        <div class="mt--10" style="width: 100%">
                                            <div class="ms-1">
                                                <i style="color: var(--color-vnua);" data-feather="calendar"></i>
                                                <span class="ms-2" style="font-size: 16px; font-weight: 500">30-04-1975</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="cmt--30" data-sal="slide-up" data-sal-duration="700">
                            <div class="rainbow-card box-card-style-default">
                                <div class="inner">
                                    <div class="thumbnail"><a class="image" href="#"><img src="{{asset('assets/client/images/clb/clb-01.jpg')}}" alt="Blog Image"></a></div>
                                    <div class="content pt--0">
                                        <h4 class="title mb--5"><a href="#">CLB học tập C/C++</a>
                                        </h4>
                                        <ul class="rainbow-meta-list">
                                            <li>Là nơi gặp gỡ, chia sẻ và học hỏi giữa các thành viên với nhau cũng như với các CLB, tổ chức bạn. Chúng tôi tạo ra một môi trường mở – nơi mọi ý tưởng đều được lắng nghe, mọi cá tính đều được tôn trọng, và mọi người đều có cơ hội thể hiện bản thân.</li>
                                        </ul>
                                        <div class="mt--10" style="width: 100%">
                                            <div class="ms-1">
                                                <i style="color: var(--color-vnua);" data-feather="calendar"></i>
                                                <span class="ms-2" style="font-size: 16px; font-weight: 500">30-04-1975</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="cmt--30" data-sal="slide-up" data-sal-duration="700">
                            <div class="rainbow-card box-card-style-default">
                                <div class="inner">
                                    <div class="thumbnail"><a class="image" href="#"><img src="{{asset('assets/client/images/clb/clb-01.jpg')}}" alt="Blog Image"></a></div>
                                    <div class="content pt--0">
                                        <h4 class="title mb--5"><a href="#">CLB học tập C/C++</a>
                                        </h4>
                                        <ul class="rainbow-meta-list">
                                            <li>Là nơi gặp gỡ, chia sẻ và học hỏi giữa các thành viên với nhau cũng như với các CLB, tổ chức bạn. Chúng tôi tạo ra một môi trường mở – nơi mọi ý tưởng đều được lắng nghe, mọi cá tính đều được tôn trọng, và mọi người đều có cơ hội thể hiện bản thân.</li>
                                        </ul>
                                        <div class="mt--10" style="width: 100%">
                                            <div class="ms-1">
                                                <i style="color: var(--color-vnua);" data-feather="calendar"></i>
                                                <span class="ms-2" style="font-size: 16px; font-weight: 500">30-04-1975</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="cmt--30" data-sal="slide-up" data-sal-duration="700">
                            <div class="rainbow-card box-card-style-default">
                                <div class="inner">
                                    <div class="thumbnail"><a class="image" href="#"><img src="{{asset('assets/client/images/clb/clb-01.jpg')}}" alt="Blog Image"></a></div>
                                    <div class="content pt--0">
                                        <h4 class="title mb--5"><a href="#">CLB học tập C/C++</a>
                                        </h4>
                                        <ul class="rainbow-meta-list">
                                            <li>Là nơi gặp gỡ, chia sẻ và học hỏi giữa các thành viên với nhau cũng như với các CLB, tổ chức bạn. Chúng tôi tạo ra một môi trường mở – nơi mọi ý tưởng đều được lắng nghe, mọi cá tính đều được tôn trọng, và mọi người đều có cơ hội thể hiện bản thân.</li>
                                        </ul>
                                        <div class="mt--10" style="width: 100%">
                                            <div class="ms-1">
                                                <i style="color: var(--color-vnua);" data-feather="calendar"></i>
                                                <span class="ms-2" style="font-size: 16px; font-weight: 500">30-04-1975</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="cmt--30" data-sal="slide-up" data-sal-duration="700">
                            <div class="rainbow-card box-card-style-default">
                                <div class="inner">
                                    <div class="thumbnail"><a class="image" href="#"><img src="{{asset('assets/client/images/clb/clb-01.jpg')}}" alt="Blog Image"></a></div>
                                    <div class="content pt--0">
                                        <h4 class="title mb--5"><a href="#">CLB học tập C/C++</a>
                                        </h4>
                                        <ul class="rainbow-meta-list">
                                            <li>Là nơi gặp gỡ, chia sẻ và học hỏi giữa các thành viên với nhau cũng như với các CLB, tổ chức bạn. Chúng tôi tạo ra một môi trường mở – nơi mọi ý tưởng đều được lắng nghe, mọi cá tính đều được tôn trọng, và mọi người đều có cơ hội thể hiện bản thân.</li>
                                        </ul>
                                        <div class="mt--10" style="width: 100%">
                                            <div class="ms-1">
                                                <i style="color: var(--color-vnua);" data-feather="calendar"></i>
                                                <span class="ms-2" style="font-size: 16px; font-weight: 500">30-04-1975</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="cmt--30" data-sal="slide-up" data-sal-duration="700">
                            <div class="rainbow-card box-card-style-default">
                                <div class="inner">
                                    <div class="thumbnail"><a class="image" href="#"><img src="{{asset('assets/client/images/clb/clb-01.jpg')}}" alt="Blog Image"></a></div>
                                    <div class="content pt--0">
                                        <h4 class="title mb--5"><a href="#">CLB học tập C/C++</a>
                                        </h4>
                                        <ul class="rainbow-meta-list">
                                            <li>Là nơi gặp gỡ, chia sẻ và học hỏi giữa các thành viên với nhau cũng như với các CLB, tổ chức bạn. Chúng tôi tạo ra một môi trường mở – nơi mọi ý tưởng đều được lắng nghe, mọi cá tính đều được tôn trọng, và mọi người đều có cơ hội thể hiện bản thân.</li>
                                        </ul>
                                        <div class="mt--10" style="width: 100%">
                                            <div class="ms-1">
                                                <i style="color: var(--color-vnua);" data-feather="calendar"></i>
                                                <span class="ms-2" style="font-size: 16px; font-weight: 500">30-04-1975</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="cmt--30" data-sal="slide-up" data-sal-duration="700">
                            <div class="rainbow-card box-card-style-default">
                                <div class="inner">
                                    <div class="thumbnail"><a class="image" href="#"><img src="{{asset('assets/client/images/clb/clb-01.jpg')}}" alt="Blog Image"></a></div>
                                    <div class="content pt--0">
                                        <h4 class="title mb--5"><a href="#">CLB học tập C/C++</a>
                                        </h4>
                                        <ul class="rainbow-meta-list">
                                            <li>Là nơi gặp gỡ, chia sẻ và học hỏi giữa các thành viên với nhau cũng như với các CLB, tổ chức bạn. Chúng tôi tạo ra một môi trường mở – nơi mọi ý tưởng đều được lắng nghe, mọi cá tính đều được tôn trọng, và mọi người đều có cơ hội thể hiện bản thân.</li>
                                        </ul>
                                        <div class="mt--10" style="width: 100%">
                                            <div class="ms-1">
                                                <i style="color: var(--color-vnua);" data-feather="calendar"></i>
                                                <span class="ms-2" style="font-size: 16px; font-weight: 500">30-04-1975</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="cmt--30" data-sal="slide-up" data-sal-duration="700">
                            <div class="rainbow-card box-card-style-default">
                                <div class="inner">
                                    <div class="thumbnail"><a class="image" href="#"><img src="{{asset('assets/client/images/clb/clb-01.jpg')}}" alt="Blog Image"></a></div>
                                    <div class="content pt--0">
                                        <h4 class="title mb--5"><a href="#">CLB học tập C/C++</a>
                                        </h4>
                                        <ul class="rainbow-meta-list">
                                            <li>Là nơi gặp gỡ, chia sẻ và học hỏi giữa các thành viên với nhau cũng như với các CLB, tổ chức bạn. Chúng tôi tạo ra một môi trường mở – nơi mọi ý tưởng đều được lắng nghe, mọi cá tính đều được tôn trọng, và mọi người đều có cơ hội thể hiện bản thân.</li>
                                        </ul>
                                        <div class="mt--10" style="width: 100%">
                                            <div class="ms-1">
                                                <i style="color: var(--color-vnua);" data-feather="calendar"></i>
                                                <span class="ms-2" style="font-size: 16px; font-weight: 500">30-04-1975</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="cmt--30" data-sal="slide-up" data-sal-duration="700">
                            <div class="rainbow-card box-card-style-default">
                                <div class="inner">
                                    <div class="thumbnail"><a class="image" href="#"><img src="{{asset('assets/client/images/clb/clb-01.jpg')}}" alt="Blog Image"></a></div>
                                    <div class="content pt--0">
                                        <h4 class="title mb--5"><a href="#">CLB học tập C/C++</a>
                                        </h4>
                                        <ul class="rainbow-meta-list">
                                            <li>Là nơi gặp gỡ, chia sẻ và học hỏi giữa các thành viên với nhau cũng như với các CLB, tổ chức bạn. Chúng tôi tạo ra một môi trường mở – nơi mọi ý tưởng đều được lắng nghe, mọi cá tính đều được tôn trọng, và mọi người đều có cơ hội thể hiện bản thân.</li>
                                        </ul>
                                        <div class="mt--10" style="width: 100%">
                                            <div class="ms-1">
                                                <i style="color: var(--color-vnua);" data-feather="calendar"></i>
                                                <span class="ms-2" style="font-size: 16px; font-weight: 500">30-04-1975</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="cmt--30" data-sal="slide-up" data-sal-duration="700">
                            <div class="rainbow-card box-card-style-default">
                                <div class="inner">
                                    <div class="thumbnail"><a class="image" href="#"><img src="{{asset('assets/client/images/clb/clb-01.jpg')}}" alt="Blog Image"></a></div>
                                    <div class="content pt--0">
                                        <h4 class="title mb--5"><a href="#">CLB học tập C/C++</a>
                                        </h4>
                                        <ul class="rainbow-meta-list">
                                            <li>Là nơi gặp gỡ, chia sẻ và học hỏi giữa các thành viên với nhau cũng như với các CLB, tổ chức bạn. Chúng tôi tạo ra một môi trường mở – nơi mọi ý tưởng đều được lắng nghe, mọi cá tính đều được tôn trọng, và mọi người đều có cơ hội thể hiện bản thân.</li>
                                        </ul>
                                        <div class="mt--10" style="width: 100%">
                                            <div class="ms-1">
                                                <i style="color: var(--color-vnua);" data-feather="calendar"></i>
                                                <span class="ms-2" style="font-size: 16px; font-weight: 500">30-04-1975</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #owl-demo .item{
            margin: 3px;
        }
        #owl-demo .item img{
            display: block;
            width: 100%;
            height: auto;
        }
    </style>

    {{--   start tham gia--}}
    <section class="quick-view">
        <div class="modal fade" id="join-clb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <livewire:client.club.modal-join-club :club="$club" />
        </div>
    </section>
    {{--   end tham gia--}}

    {{--   start cập nhật thông tin--}}
    <section class="quick-view">
        <div class="modal fade" id="clubDescription" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <livewire:client.club.modal-update :club="$club" />
            </div>
        </div>
    </section>
    {{--   end cập nhật thông tin--}}
@endsection
@section('script_custom')
    <script>
        $(document).ready(function() {
            $('#selectKhoa').select2({
                placeholder: "Chọn một Khoa",
                dropdownParent: $('#join-clb'),
                language: {
                    noResults: function () {
                        return "Không tìm thấy kết quả";
                    },
                    searching: function () {
                        return "Đang tìm kiếm...";
                    },
                    inputTooShort: function () {
                        return "Nhập thêm ký tự để tìm kiếm";
                    }
                }
            });
            $('#selectKhoa').on('select2:open', function () {
                setTimeout(() => {
                    document.querySelector('.select2-search__field').placeholder = "Tìm kiếm khoa";
                }, 0);
            });
        });
    </script>
@endsection


