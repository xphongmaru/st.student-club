@extends('client.layouts.master')
@section('title')
    Quản lý tài khoản
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
{{--                            <li class="rainbow-breadcrumb-item active">{{$club->name}}</li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcarumb area  -->

    <section class="account py-4" >
        <div class="container d-flex ">
            <div class="sidebar">
                <livewire:client.account.avarta-user/>
                <div class="sidebar_content mt-3">
                    <ul class="list_item mt-3">
                        <li class="item">
                            <a class="toggle-link @if($item==1) active @endif" id="item1" data-bs-toggle="collapse" href="#collapseProfile" aria-expanded="false">
                                Thông tin tài khoản
                            </a>
                        </li>
                        <li class="item">
                            <a class="toggle-link @if($item==2) active @endif" id="item2" data-bs-toggle="collapse" href="#collapseNotification" aria-expanded="false">
                                Thông báo
                            </a>
                        </li>
                        <li class="item">
                            <a class="toggle-link @if($item==3) active @endif" id="item3" data-bs-toggle="collapse" href="#ListClubYouJoin" aria-expanded="false">
                                CLB bạn tham gia
                            </a>
                        </li>
                        <li class="item">
                            <a class="toggle-link @if($item==4) active @endif" id="item4" data-bs-toggle="collapse" href="#RequetsClub" aria-expanded="false">
                                Đăng ký CLB
                            </a>
                        </li>
                        <li class="item">
                            <a class="toggle-link @if($item==5) active @endif" id="item5" data-bs-toggle="collapse" href="#ClubInviteMember" aria-expanded="false">
                                Lời mời tham gia CLB
                            </a>
                        </li>
                        <li class="item">
                            <a class="" href="{{route('handelLogout')}}" id="item5">
                                Đăng xuất
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <!-- Nhóm các phần tử collapse vào một div có id="accordion" -->
                <div id="accordion">
                    <div id="collapseProfile" class="collapse @if($item==1) show @endif" data-bs-parent="#accordion">
                        <livewire:client.account.infor-user/>
                    </div>
                    <div id="collapseNotification" class="collapse @if($item==2) show @endif" data-bs-parent="#accordion">
                        <livewire:client.account.notification/>
                    </div>
                    <div id="ListClubYouJoin" class="collapse @if($item==3) show @endif" data-bs-parent="#accordion">
                        <livewire:client.account.club-joined/>
                    </div>
                    <div id="RequetsClub" class="collapse @if($item==4) show @endif" data-bs-parent="#accordion">
                        <livewire:client.account.request-club/>
                    </div>
                    <div id="ClubInviteMember" class="collapse @if($item==5) show @endif" data-bs-parent="#accordion">
                        <livewire:client.account.club-invite-member/>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script_custom')
    <script>
        $(document).ready(function() {
            $('#selectKhoa').select2({
                placeholder: "Chọn một Khoa",
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
