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
                    <div class="content-action">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#appointment_notice" type="button" class="btn btn-teal"><i class="ph-calendar me-2"></i>Hẹn phỏng vấn</a>
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
                            <th class="text-center" style="width: 20%">Tên người gửi</th>
                            <th class="text-center" style="width: 10%">Mã sinh viên</th>
                            <th class="text-center" style="width: 9%">Giới tính</th>
                            <th class="text-center" style="width: 10%">Số điện thoại</th>
                            <th class="text-center" style="width: 10%">Lớp</th>
                            <th class="text-center" style="width: 10%">Trạng thái</th>
                            <th class="text-center" style="width: 10%; text-align: center">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($requests->isEmpty())
                            <tr>
                                <td colspan="100%" class="text-center">
                                    <img src="{{ asset('assets/admin/images/empty.png') }}" alt="Không tìm thấy kết quả" style="width: 400px;" />
                                </td>
                            </tr>
                        @else
                            @foreach($requests as $request)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $request->name }}</td>
                                    <td class="text-center">{{ $request->code }}</td>
                                    <td class="text-center">{{ $request->gender }}</td>
                                    <td class="text-center">{{ $request->phone_number }}</td>
                                    <td class="text-center">{{ $request->class }}</td>
                                    @php
                                        $statusEnum = App\Enums\StatusJoinClub::mapValue($request->status);
                                    @endphp
                                    <td class="text-center">
                                    <span class="
                                        @switch($statusEnum)
                                            @case(App\Enums\StatusJoinClub::Pending) badge bg-warning @break
                                            @case(App\Enums\StatusJoinClub::Approved) badge bg-success @break
                                            @case(App\Enums\StatusJoinClub::Rejected) badge bg-danger @break
                                            @case(App\Enums\StatusJoinClub::Cancelled) badge bg-yellow @break
                                            @case(App\Enums\StatusJoinClub::In_review) badge bg-info @break
                                            @case(App\Enums\StatusJoinClub::Interview) badge bg-primary @break
                                            @case(App\Enums\StatusJoinClub::Fail) badge bg-yellow @break
                                        @endswitch
                                    ">
                                        {{ $statusEnum->label() }}
                                    </span>
                                    </td>

                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                <i class="ph-list"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="{{ route('admin.club.recruitment-member.detail-request', ['id' => $club_id, 'recruitment_id' => $recruitment_id, 'request_id'=> $request->id])}}" class="dropdown-item">
                                                    <i class="ph-pencil me-2"></i>
                                                    Xem chi tiết
                                                </a>
                                                <button type="button" wire:click="AgreeRequest({{ $request->id }})" class="dropdown-item text-success">
                                                    <i class="ph-check me-2"></i>
                                                    Duyệt đơn
                                                </button>
                                                <button type="button" wire:click="openDeleteModel({{ $request->id }})" class="dropdown-item text-danger">
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
                            {{ $requests->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
