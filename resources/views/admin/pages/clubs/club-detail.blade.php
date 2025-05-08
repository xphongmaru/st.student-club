@extends('admin.layouts.master')

@section('page-header')
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Thông tin chi tiết CLB
                </h4>
            </div>

        </div>

        <div class="page-header-content d-lg-flex border-top">
            <div class="d-flex">
                <div class="breadcrumb py-2">
                    <a href="{{route('admin.dashboard')}}" class="breadcrumb-item"><i class="ph-house"></i></a>
                    <a href="#" class="breadcrumb-item active">Câu lạc bộ</a>
                    <a href="{{route('admin.club.index')}}" class="breadcrumb-item active">Danh sách CLB</a>
                    <span class="breadcrumb-item active">Chi tiết CLB</span>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('page-content')
    <div class="content">
        <!-- Content -->
        <livewire:admin.clubs.club-detail :id="$id"></livewire:admin.clubs.club-detail >
        <!-- /Content -->
    </div>

    {{--   start đổi chủ tịch--}}
    <section class="quick-view">
        <div class="modal fade" id="change_president" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="top:30%">
                <livewire:admin.clubs.modal-change-president :club_id="$id" />
            </div>
        </div>
    </section>
    {{--   end đổi chủ tịch--}}
@endsection
@section('script_custom')
    <script>
        $(document).ready(function() {
            $('#selectCLB').select2({
                // placeholder: "Chọn một câu lạc bộ",
                dropdownParent: $('#change_president'),
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
                    document.querySelector('.select2-search__field').placeholder = "Tìm kiếm thành viên ";
                }, 0);
            });

            Livewire.on('closeModal', () => {
                // Đóng modal bằng jQuery hoặc Bootstrap
                $('#selectCLB').modal('hide');
            });

        });
    </script>
@endsection
