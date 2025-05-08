@extends('admin.layouts.master')

@section('page-header')
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Bảng điều khiển
                </h4>
            </div>
        </div>

        <div class="page-header-content d-lg-flex border-top">
            <div class="d-flex">
                <div class="breadcrumb py-2">
                    <a href="#" class="breadcrumb-item"><i class="ph-house"></i></a>
                    <span class="breadcrumb-item active">Bảng điều khiển</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-content')
    <!-- Content area -->
    <div class="content">

        @if(session('club_id'))
        <div>
            <livewire:admin.dashboards.club-infor></livewire:admin.dashboards.club-infor>
        </div>
        @else

        @endif

    </div>
@endsection

