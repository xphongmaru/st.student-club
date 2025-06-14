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
                            <li class="rainbow-breadcrumb-item"><a href="{{route('client.account',['item'=>2])}}">Danh sách thông báo</a></li>
                            <li class="rainbow-breadcrumb-item active">{{$notification->title}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcarumb area  -->
    <!-- Start Advance Pricing Area  -->
    <livewire:client.notification.detail :notification="$notification"/>
    <!-- End Advance Pricing Area  -

@endsection

