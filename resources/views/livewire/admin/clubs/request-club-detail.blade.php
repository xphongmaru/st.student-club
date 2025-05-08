<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-info"></i>
                Thông tin đơn đăng ký
            </div>

            <div class="card-body">
                <div class="form-group mt-2">
                    <label class="form-label">
                        Tên câu lạc bộ: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="name" type="text" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">
                        Người yêu cầu: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="full_name_user" type="text" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">
                        Lĩnh vực hoạt động: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="field" type="text" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">
                        Mô tả câu lạc bộ: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <textarea  wire:model.live="description" type="text" class="form-control" readonly></textarea>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">
                        Ảnh logo CLB: <span class="text-danger">*</span>
                    </label>
                    <div class="" style="background-color: rgba(0, 140, 255, 0.062); border-radius: 16px; padding: 16px 100px">
                        <img src="{{asset('storage/'.$clubRequest->thumbnail)}}" alt="" style="max-height: 200px; object-fit: cover;">
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">
                        Trạng thái: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <select wire:model.live="statusNew" class="form-control select" data-minimum-results-for-search="Infinity">
                            @foreach(\App\Enums\StatusRequestClub::cases() as $status)
                                <option  value="{{ $status->value }}" class="" @selected($clubRequest->status == $status->value)>{{ $status->label() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-gear-six"></i>
                Hành động
            </div>
            <div class="card-body d-flex align-items-center gap-1">
                <button wire:click="update" class="btn btn-primary" type="submit"><i class="ph-floppy-disk"></i>Chỉnh sửa</button>
                <a href="{{ route('admin.request-club.list') }}" type="button" class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
            </div>
        </div>
    </div>
</div>
