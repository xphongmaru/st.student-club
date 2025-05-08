@extends('admin.layouts.master')

@section('page-header')
    <div class="page-header page-header-light shadow">
        <div class="page-header-content d-lg-flex">
            <div class="d-flex">
                <h4 class="page-title mb-0">
                    Danh sách thành viên trong Câu lạc bộ
                </h4>
            </div>

        </div>

        <div class="page-header-content d-lg-flex border-top">
            <div class="d-flex">
                <div class="breadcrumb py-2">
                    <a href="{{route('admin.dashboard')}}" class="breadcrumb-item"><i class="ph-house"></i></a>
                    <a href="#" class="breadcrumb-item active">Câu lạc bộ</a>
                    <a href="#" class="breadcrumb-item active">Danh sách thành viên</a>
                </div>
            </div>

        </div>
    </div>
    {{--modal thêm thành viên --}}
    <section class="quick-view">
        <div class="modal fade" id="invite_member" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="top:15%">
                <livewire:admin.clubs.modal-invite-member :club_id="$club_id"/>

            </div>
        </div>
    </section>
@endsection

@section('page-content')
    <div class="content">
        <!-- Content -->
        <livewire:admin.clubs.member-index :club_id="$club_id"></livewire:admin.clubs.member-index:club_id>
        <!-- /Content -->
    </div>
@endsection

@section('script_custom')
    <script>
        $(document).ready(function() {
            $('#selectUser').select2({
                // placeholder: "Chọn một câu lạc bộ",
                dropdownParent: $('#invite_member'),
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
            $('#selectUser').on('select2:open', function () {
                setTimeout(() => {
                    document.querySelector('.select2-search__field').placeholder = "Tìm kiếm thành viên ";
                }, 0);
            });

        });
    </script>
@endsection

