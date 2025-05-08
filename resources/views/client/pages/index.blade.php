@extends('client.layouts.master')
@section('title')
    Trang chủ
@endsection

@section('content')
    <!-- Start Slider Area  -->
    <div class="slider-area slider-activation slider-style-4 slider-dot rainbow-slick-dot rainbow-slick-arrow" style="margin-top: 80px">
        <!-- Start Single Slider  -->
        <div class="height-850 bg_image bg_image--7 d-flex align-items-center" data-black-overlay="5">
            <div class="container">
                <div class="row row--30 align-items-center">
                    <div class="col-12">
                        <div class="inner text-center">
                            <h1 class="title">Giao lưu</h1>
                            <p class="description">Là nơi gặp gỡ, chia sẻ và học hỏi giữa các thành viên với nhau cũng như với các CLB, tổ chức bạn.</p>
                            <div class="button-group mt--30">
{{--                                <a class="btn-default" href="#">Tìm hiểu thêm</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider  -->
        <!-- Start Single Slider  -->
        <div class="height-850 bg_image bg_image--8 d-flex align-items-center" data-black-overlay="5">
            <div class="container">
                <div class="row row--30 align-items-center">
                    <div class="col-12">
                        <div class="inner text-center">
                            <h1 class="title">Kết nối</h1>
                            <p class="description">Không chỉ kết nối giữa người với người, mà còn kết nối đam mê, kiến thức và trải nghiệm. CLB là cầu nối giữa sinh viên và thực tiễn, giữa cá nhân và tập thể, giữa hiện tại và cơ hội phía trước.</p>
                            <div class="button-group mt--30">
{{--                                <a class="btn-default" href="#">Tìm hiểu thêm</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider  -->
        <!-- Start Single Slider  -->
        <div class="height-850 bg_image bg_image--9 d-flex align-items-center" data-black-overlay="5">
            <div class="container">
                <div class="row row--30 align-items-center">
                    <div class="col-12">
                        <div class="inner text-center">
                            <h1 class="title">Phát triển</h1>
                            <p class="description">Mỗi bước đi trong CLB là một bước trưởng thành – không chỉ trong học tập mà cả trong cuộc sống.</p>
                            <div class="button-group mt--30">
{{--                                <a class="btn-default" href="#">Tìm hiểu thêm</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider  -->
    </div>
    <!-- End Slider Area  -->

    <!-- Start Service__Style--1 Area  -->
    <div class="rainbow-service-area rainbow-section-gap" style="padding-top: 40px !important">
        <div class="container">
            <div class="row row--15 service-wrapper">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" data-sal="slide-up" data-sal-duration="700">
                    <div class="service service__style--1 bg-color-blackest radius mt--25 text-center rbt-border-none">
                        <div class="icon">
                            <img src="{{asset('assets\admin\images\logo_vnua.png')}}" alt="">
                        </div>
                        <div class="content">
                            <h4 class="title w-600">
                                <span>Phát triển kỹ năng</span>
                            </h4>
                            <p class="description b1 mb--0">Rèn luyện kỹ năng mềm và chuyên môn.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" data-sal="slide-up" data-sal-duration="700">
                    <div class="service service__style--1 bg-color-blackest radius mt--25 text-center rbt-border-none">
                        <div class="icon">
                            <img src="{{asset('assets\admin\images\logo_vnua.png')}}" alt="">
                        </div>
                        <div class="content">
                            <h4 class="title w-600">
                                <span>Giao lưu kết bạn</span>
                            </h4>
                            <p class="description b1 mb--0">Kết nối với những người có chung sở thích.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" data-sal="slide-up" data-sal-duration="700">
                    <div class="service service__style--1 bg-color-blackest radius mt--25 text-center rbt-border-none">
                        <div class="icon">
                            <img src="{{asset('assets\admin\images\logo_vnua.png')}}" alt="">
                        </div>
                        <div class="content">
                            <h4 class="title w-600">
                                <span>Cơ hội phát triển</span>
                            </h4>
                            <p class="description b1 mb--0">Mở rộng cơ hội nghề nghiệp tương lai.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12" data-sal="slide-up" data-sal-duration="700">
                    <div class="service service__style--1 bg-color-blackest radius mt--25 text-center rbt-border-none">
                        <div class="icon">
                            <img src="{{asset('assets\admin\images\logo_vnua.png')}}" alt="">
                        </div>
                        <div class="content">
                            <h4 class="title w-600">
                                <span>Kỹ năng lãnh đạo</span>
                            </h4>
                            <p class="description b1 mb--0">Phát triển kỹ năng quản lý và lãnh đạo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Service__Style--1 Area  -->

    <!-- Start Blog Area  -->
    <div class="blog-area rainbow-section-gap pt--0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center" data-sal="slide-up" data-sal-duration="700" data-sal-delay="100">
                        <h2 class="title w-600 mb--20">Các câu lạc bộ nổi bật</h2>
                        <p class="description b1">Tìm hiểu các câu lạc bộ được yêu thích nhất tại trường</p>
                    </div>
                </div>
            </div>
                <livewire:client.index.club-list />
            <div class="col-lg-12">
                <div class="rainbow-load-more text-center mt--40">
                    <a href="#" class="btn btn-default btn-icon round">
                                <span>Xem thêm
                                    <span class="icon">
                                        <i data-feather="arrow-right"></i>
                                        </span>
                                    </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog Area  -->

    <div class="rainbow-callto-action clltoaction-style-default bg-image bg-image2 bg_image_fixed" data-black-overlay="7">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner">
                        <div class="content text-center">
                            <h2 class="title" data-sal="slide-up" data-sal-duration="400" data-sal-delay="200">Bạn đã sẵn sàng tham gia hoặc thành lập một câu lạc bộ chưa?</h2>
                            <h6 class="subtitle" data-sal="slide-up" data-sal-duration="400" data-sal-delay="300">Đừng bỏ lỡ cơ hội trở thành một phần của cộng đồng sinh viên năng động.</h6>
                            <div class="btn-index d-flex justify-content-center">
                                <div class="button-group mt--20 mx-3">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#establish-clb" class="btn-default round">Đăng ký thành lập CLB</a>
                                </div>
                                <div class="button-group mt--20 mx-3">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#join-clb" class="btn-default round">Đăng ký tham gia CLB</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Blog List View  -->
    <div class="main-content">
        <div class="rainbow-blog-area rainbow-section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center" data-sal="slide-up" data-sal-duration="700" data-sal-delay="100">
                            <h2 class="title w-600 mb--20">Tin tức mới nhất</h2>
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

    <!-- đăng ký start -->
    <section class="quick-view">
        <div class="modal fade" id="establish-clb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <livewire:client.index.form-request-club />
            </div>
        </div>
    </section>
    <!-- đăng ký end -->

    {{--   start tham gia--}}
    <section class="quick-view">
        <div class="modal fade" id="join-clb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <livewire:client.index.form-join-club />
            </div>
        </div>
    </section>
    {{--   end tham gia--}}

@endsection
@section('script_custom')
    <script>
        $(document).ready(function() {
            $('#selectCLB').select2({
                placeholder: "Chọn một câu lạc bộ",
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
            $('#selectCLB').on('select2:open', function () {
                setTimeout(() => {
                    document.querySelector('.select2-search__field').placeholder = "Tìm kiếm câu lạc bộ";
                }, 0);
            });

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
