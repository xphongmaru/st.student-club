@extends('admin.layouts.master')

@section('page-header')
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Danh sách đơn đăng ký của đợt tuyển thành viên
                </h4>
            </div>

        </div>

        <div class="page-header-content d-lg-flex border-top">
            <div class="d-flex">
                <div class="breadcrumb py-2">
                    <a href="{{route('admin.dashboard')}}" class="breadcrumb-item"><i class="ph-house"></i></a>
                    <a href="#" class="breadcrumb-item active">Câu lạc bộ</a>
                    <a href="{{route('admin.club.recruitment-member-index',['id'=> $club_id])}}" class="breadcrumb-item active">Tuyển thành viên</a>
                    <a href="#" class="breadcrumb-item active">Danh sách đơn đăng ký </a>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('page-content')
    <div class="content">
        <!-- Content -->
        <livewire:admin.clubs.recruitment-members.requests.index :club_id="$club_id" :recruitment_id="$recruitment_id"/>
        <!-- /Content -->
    </div>
{{--modal hẹn phỏng vấn --}}
    <section class="quick-view">
        <div class="modal fade" id="appointment_notice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="top:5%">
                <livewire:admin.clubs.recruitment-members.requests.modal-appointment-notice :club_id="$club_id" :recruitment_id="$recruitment_id"/>

            </div>
        </div>
    </section>
@endsection

