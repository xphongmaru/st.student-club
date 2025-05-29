@extends('client.layouts.master')
@section('title')
    Bài viết câu lạc bộ
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
                            <li class="rainbow-breadcrumb-item"><a href="{{route('client.page-club',['id'=>$club->id])}}">{{$club->name}}</a></li>
                            <li class="rainbow-breadcrumb-item"><a href="{{route('client.club.post',['id'=>$club->id])}}">Bài viết</a></li>
                            <li class="rainbow-breadcrumb-item active">{{$post->title}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcarumb area  -->
    <!-- Start Advance Pricing Area  -->
    <livewire:client.club.post.detail :post="$post"/>
    <!-- End Advance Pricing Area  -

@endsection

{{--@section('script_custom')--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('#selectKhoa').select2({--}}
{{--                placeholder: "Chọn một Khoa",--}}
{{--                language: {--}}
{{--                    noResults: function () {--}}
{{--                        return "Không tìm thấy kết quả";--}}
{{--                    },--}}
{{--                    searching: function () {--}}
{{--                        return "Đang tìm kiếm...";--}}
{{--                    },--}}
{{--                    inputTooShort: function () {--}}
{{--                        return "Nhập thêm ký tự để tìm kiếm";--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--            $('#selectKhoa').on('select2:open', function () {--}}
{{--                setTimeout(() => {--}}
{{--                    document.querySelector('.select2-search__field').placeholder = "Tìm kiếm khoa";--}}
{{--                }, 0);--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
