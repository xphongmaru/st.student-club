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
                                           placeholder="Nhập vào tên tòa nhà ..."
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
                    <a href="#" class="btn btn-teal"><i class="ph-plus-circle me-1"></i> Tạo mới</a>
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
                        <th class="text-center" style="width: 1%">STT</th>
                        <th class="text-center" style="width: 26%">Tên câu lạc bộ</th>
                        <th class="text-center" style="width: 25%">Lĩnh vực hoạt động</th>
                        <th class="text-center" style="width: 12%">Logo</th>
                        <th class="text-center" style="width: 20%">Trạng thái</th>
                        <th class="text-center" style="width: 15%">Người yêu cầu</th>
                        <th class="text-center" style="width: 1%; text-align: center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($requestClubs->isEmpty())
                        <tr>
                            <td colspan="100%" class="text-center">
                                <img src="{{ asset('assets/admin/images/empty.png') }}" alt="Không tìm thấy kết quả" style="width: 400px;" />
                            </td>
                        </tr>
                    @else
                        @foreach($requestClubs as $requestClub)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $requestClub->name }}</td>
                                <td class="text-center">{{ $requestClub->field_of_activity}}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $requestClub->thumbnail) }}" alt="" style="width: 60px; object-fit: cover;">
                                </td>
                                @php
                                    $statusEnum = App\Enums\StatusRequestClub::mapValue($requestClub->status);
                                @endphp
                                <td class="text-center">
                                    <span class="
                                        @switch($statusEnum)
                                            @case(App\Enums\StatusRequestClub::Pending) badge bg-warning @break
                                            @case(App\Enums\StatusRequestClub::Approved) badge bg-success @break
                                            @case(App\Enums\StatusRequestClub::Rejected) badge bg-danger @break
                                            @case(App\Enums\StatusRequestClub::Cancelled) badge bg-yellow @break
                                            @case(App\Enums\StatusRequestClub::In_review) badge bg-info @break
                                        @endswitch
                                    ">
                                        {{ $statusEnum->label() }}
                                    </span>
                                </td>


                                <td class="text-center">{{ $requestClub->user->full_name}}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a href="#" class="text-body" data-bs-toggle="dropdown">
                                            <i class="ph-list"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{ route('admin.request-club.detail', ['id' => $requestClub->id]) }}" class="dropdown-item">
                                                <i class="ph-pencil me-2"></i>
                                                Xem chi tiết
                                            </a>
                                            <button type="button" wire:click="openApproveModel({{ $requestClub->id }})" class="dropdown-item text-success">
                                                <i class="ph-check me-2"></i>
                                                Duyệt đơn
                                            </button>
                                            <button type="button" wire:click="openDeleteModel({{ $requestClub->id }})" class="dropdown-item text-danger">
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
                        {{ $requestClubs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
