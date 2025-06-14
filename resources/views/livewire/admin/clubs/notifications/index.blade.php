<div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="content-header d-flex justify-content-between align-items-end">
                    <div class="content-filter w-50">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="form-group">
                                    <label for="user-search-input">Tìm kiếm</label>
                                    <div class="form-control-feedback form-control-feedback-end">
                                        <input wire:model.live="search" type="text" name="q"
                                               placeholder="Nhập vào thông tin tìm kiếm..."
                                               class="form-control" id="user-search-input">
                                        <div class="form-control-feedback-icon">
                                            <i class="ph-magnifying-glass"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-action d-flex">
                        <a href="{{route('admin.club.notification-create',['id'=>$club_id])}}" class="btn btn-teal"><i class="ph-plus-circle me-1"></i>Tạo mới</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="">
                    <div wire:loading class="my-3 text-center w-100">
                        <span class="spinner-border spinner-border-sm"></span> Đang tải dữ liệu...
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 1%">STT</th>
                            <th class="text-center" style="width: 30%">Tiêu đề</th>
                            <th class="text-center" style="width: 30%">Nội dung ngắn</th>
                            <th class="text-center" style="width: 10%">Người đăng thông báo</th>
                            <th class="text-center" style="width: 1%; text-align: center">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($notifications->isEmpty())
                            <tr>
                                <td colspan="100%" class="text-center">
                                    <img src="{{ asset('assets/admin/images/empty.png') }}" alt="Không tìm thấy kết quả" style="width: 400px;" />
                                </td>
                            </tr>
                        @else
                            @foreach($notifications as $notification)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        {{$notification->title}}
                                    </td>
                                    @php
                                        $textOnlyContent = preg_replace('/<img[^>]*>/i', '', $notification->content);
                                    @endphp

                                    <td class="text-center"
                                        style="line-height: 18px; height: calc(21px * 4); display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; margin-bottom: 10px">
                                        {{ strip_tags($textOnlyContent) }}
                                    </td>
                                    <td class="text-center">
                                        {{$notification->getSender()->full_name}}
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                <i class="ph-list"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{ route('admin.club.notification-detail', ['id' => $club_id, 'notification_id'=> $notification->id])}}" class="dropdown-item">
                                                    <i class="ph-eye me-2"></i>
                                                    Xem chi tiết
                                                </a>
                                                <a href="{{ route('admin.club.notification-edit', ['id' => $club_id, 'notification_id'=> $notification->id])}}" class="dropdown-item text-warning">
                                                    <i class="ph-pencil me-2"></i>
                                                    Chỉnh sửa
                                                </a>
                                                <button type="button" wire:click="openDeleteModel({{ $notification->id }})" class="dropdown-item text-danger">
                                                    <i class="ph-trash me-2"></i>
                                                    Xóa
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end align-items-center w-100 mt-3">
                        <div class="pagination">
                            {{ $notifications->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
