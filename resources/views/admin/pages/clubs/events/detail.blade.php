@extends('admin.layouts.master')

@section('page-header')
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Thông tin chi tiết bài viết CLB
                </h4>
            </div>

        </div>

        <div class="page-header-content d-lg-flex border-top">
            <div class="d-flex">
                <div class="breadcrumb py-2">
                    <a href="{{route('admin.dashboard')}}" class="breadcrumb-item"><i class="ph-house"></i></a>
                    <a href="#" class="breadcrumb-item active">Câu lạc bộ</a>
                    <a href="{{route('admin.club.event-index',['id'=>$club_id])}}" class="breadcrumb-item active">Danh sách sự kiện</a>
                    <span class="breadcrumb-item active"> Thông tin chi tiết sự kiện </span>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('page-content')
    <div class="content">
        <!-- Content -->
        <livewire:admin.clubs.events.detail :id="$club_id" :event_id="$event_id"/>
        <!-- /Content -->
    </div>
@endsection
