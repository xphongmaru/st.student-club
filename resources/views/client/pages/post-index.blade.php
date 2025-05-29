@extends('client.layouts.master')
@section('title')
    Danh sách bài viết
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
                            <li class="rainbow-breadcrumb-item active">Bài viết</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcarumb area  -->
    <!-- Start Blog-Grid Sidebar  -->
    <div class="main-content">
        <div class="rainbow-blog-area pt--60">
            <livewire:client.post.index/>
        </div>
    </div>
    <!-- End Blog-Grid Sidebar  -->

@endsection
