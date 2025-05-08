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
                        <th class="text-center" style="width: 30%">Tên câu lạc bộ</th>
                        <th class="text-center" style="width: 28%">Chủ tịch</th>
                        <th class="text-center" style="width: 20%">Logo</th>
                        <th class="text-center" style="width: 20%">Trạng thái</th>
                        <th class="text-center" style="width: 1%; text-align: center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($clubs->isEmpty())
                        <tr>
                            <td colspan="100%" class="text-center">
                                <img src="{{ asset('assets/admin/images/empty.png') }}" alt="Không tìm thấy kết quả" style="width: 400px;" />
                            </td>
                        </tr>
                    @else
                        @foreach($clubs as $club)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $club->name }}</td>
                                <td class="text-center">{{ $club->getUser($club->owner_id)->full_name}}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $club->thumbnail) }}" alt="" style="width: 60px; object-fit: cover;">
                                </td>
                                @php
                                    $statusEnum = App\Enums\StatusClub::mapValue($club->status);
                                @endphp
                                <td class="text-center">
                                    <span class="
                                        @switch($statusEnum)
                                            @case(App\Enums\StatusClub::Inactive) badge bg-warning @break
                                            @case(App\Enums\StatusClub::Active) badge bg-success @break
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
                                            <a href="{{ route('admin.club.detail', ['id' => $club->id]) }}" class="dropdown-item">
                                                <i class="ph-pencil me-2"></i>
                                                Xem chi tiết
                                            </a>
                                            @if($club->status == App\Enums\StatusClub::Inactive->value)
                                                <button type="button" wire:click="openStatusClub({{ $club->id }})" class="dropdown-item text-success">
                                                    <i class="ph-check me-2"></i>
                                                    Mở hoạt động CLB
                                                </button>
                                            @elseif($club->status == App\Enums\StatusClub::Active->value)
                                                <button type="button" wire:click="closeStatusClub({{ $club->id }})" class="dropdown-item text-warning">
                                                    <i class="ph-x me-2"></i>
                                                    Ngừng hoạt động CLB
                                                </button>
                                            @endif
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
                        {{ $clubs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
