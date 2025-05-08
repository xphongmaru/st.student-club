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
                                               placeholder="Nhập vào tên thành viên..."
                                               class="form-control" id="user-search-input">
                                        <div class="form-control-feedback-icon">
                                            <i class="ph-magnifying-glass"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-action">
                        <a href="{{route('admin.club.role-create',['id'=>$club_id])}}" class="btn btn-teal"><i class="ph-plus-circle me-1"></i>Tạo mới</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 10%">STT</th>
                            <th class="text-center" style="width: 70%">Chức vụ</th>
                            <th class="text-center" style="width: 20%; text-align: center">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($roles->isEmpty())
                            <tr>
                                <td colspan="100%" class="text-center">
                                    <img src="{{ asset('assets/admin/images/empty.png') }}" alt="Không tìm thấy kết quả" style="width: 400px;" />
                                </td>
                            </tr>
                        @else
                            @foreach($roles as $role)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $role->name }}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                <i class="ph-list"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{ route('admin.club.role-detail', ['id' => $club_id, 'role_id'=> $role->id])}}" class="dropdown-item">
                                                    <i class="ph-pencil me-2"></i>
                                                    Xem chi tiết
                                                </a>
                                                <button type="button" wire:click="openDeleteModel({{ $role->id }})" class="dropdown-item text-danger">
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
                            {{ $roles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
