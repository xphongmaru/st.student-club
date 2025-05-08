<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-info"></i>
                Thông tin chức vụ
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">
                        Tên đợt tuyển thành viên: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="name" type="text" placeholder="Nhập vào tên đợt tuyển thành viên" class="form-control  @error('name') is-invalid @enderror">
                        @error('name')
                        <label class="text-danger mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">
                        Thời gian bắt đầu: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="start_date" type="datetime-local" class="form-control  @error('start_date') is-invalid @enderror">
                        @error('start_date')
                        <label class="text-danger mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">
                        Thời gian kết thúc: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="end_date" type="datetime-local" class="form-control  @error('end_date') is-invalid @enderror">
                        @error('end_date')
                        <label class="text-danger mt-1">{{ $message }}</label>
                        @enderror
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
                <button wire:click="store" class="btn btn-primary" type="submit"><i class="ph-floppy-disk"></i>Tạo mới</button>
                <a href="{{ route('admin.club.recruitment-member-index',['id'=>$club_id]) }}" type="button" class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
            </div>
        </div>
    </div>
</div>
