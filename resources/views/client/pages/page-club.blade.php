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
                        <ul class="page-list">
                            <li class="rainbow-breadcrumb-item"><a href="{{route('client.index')}}">Trang chủ</a></li>
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
                            <h2 class="title w-600 mb--20">Bài viết mới nhất </h2>
                        </div>
                    </div>
                </div>
                <livewire:client.club.list-post :club="$club"/>
            </div>
        </div>
    </div>
    <!-- End Blog List View  -->

    <div class="main-content">
        <div class="rainbow-blog-area rainbow-section-gap pt--20">
            <livewire:client.club.list-event :club="$club"/>
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

    {{--   start quick view event--}}
    <section class="quick-view">
        <div class="modal fade" id="quickViewEvent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 1200px!important;">
                <livewire:client.club.quick-view-event :club="$club" />
            </div>
        </div>
    </section>
    {{--   end quick view event--}}
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
    <script>
        function initGallery(selector = '#animated-lightbox3') {
            const el = document.querySelector(selector);
            if (el) {
                if (el.classList.contains('lg-initialized')) {
                    el.lgDestroy && el.lgDestroy();
                }
                lightGallery(el, {
                    selector: 'a',
                    thumbnail: true,
                    animateThumb: true,
                    showThumbByDefault: true,
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            initGallery(); // khởi tạo lần đầu

            Livewire.on('loadPhoto', () => {
                setTimeout(() => initGallery(), 100); // đợi DOM cập nhật xong
            });
        });
    </script>
@endsection


