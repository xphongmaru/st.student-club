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
                        Chức vụ: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="name" type="text" placeholder="Nhập vào tên chức vụ" class="form-control  @error('name') is-invalid @enderror">
                        @error('name')
                        <label class="text-danger mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label">
                            Quyền hạn: <span class="text-danger">*</span>
                        </label>
                        <div>
                            @foreach($permissions as $permission)
                                <input wire:model.live="permission_ids" type="checkbox" id="permission_{{$permission->id}}"
                                       name="permissions[]" value="{{$permission->id}}" class="ms-3">
                                <label for="permission_{{$permission->id}}"> {{$permission->name}}</label><br>
                            @endforeach
                            @error('permission_ids')
                            <label class="text-danger mt-1">{{ $message }}</label>
                            @enderror
                        </div>
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
                <a href="{{ route('admin.club.role-index',['id'=>$club_id]) }}" type="button" class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
            </div>
        </div>
    </div>
</div>
