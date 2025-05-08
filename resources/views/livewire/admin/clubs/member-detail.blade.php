<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-info"></i>
                Thông tin thành viên
            </div>
            <div class="card-body fs-6">
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0 10px; ">
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Tên thành viên:</span>
                            <span>{{$member->full_name}}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Mã sinh viên:</span>
                            <span>{{$member->code}}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Email:</span>
                            <span>{{$member->email!=null?$member->email:"<chưa xác định>"}}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Số điện thoại:</span>
                            <span>{{$member->phone!=null?$member->phone:"<chưa xác định>"}}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Địa chỉ:</span>
                            <span>{{$member->address!=null?$member->address:"<chưa xác định>"}}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Giới tính:</span>
                            <span>{{$member->gender!=null?$member->gender:"<chưa xác định>"}}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Ngày sinh:</span>
                            <span>{{$member->gender!=null?$member->gender:"<chưa xác định>"}}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Khoa:</span>
                            <span>{{$member->faculty_id!=null?$member->faculty->name:"<chưa xác định>"}}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Lớp:</span>
                            <span>{{$member->class_name!=null?$member->class_name:"<chưa xác định>"}}</span>
                        </label>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label fw-bold">
                        Ảnh đại diện:
                    </label>
                    <div class="" style="background-color: rgba(0, 140, 255, 0.062); border-radius: 16px; padding: 16px 100px">
                        <img src="{{asset('storage/'.$member->thumbnail)}}" alt="" style="max-height: 200px; object-fit: cover;">
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label fw-bold">
                        Chức vụ:
                    </label>
                    <div>
                        <select wire:model="roleClub" class="form-control select" data-minimum-results-for-search="Infinity">
                            @foreach($roleClubs as $roleClub)
                                <option  value="{{ $roleClub->id }}" class="">{{ $roleClub->name }}</option>
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
                <button wire:click="update" class="btn btn-primary" type="submit"><i class="ph-floppy-disk"></i>Cập nhật</button>
                <a href="{{ route('admin.club.member-index', ['id'=>$club_id]) }}" type="button" class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
            </div>

        </div>
    </div>
</div>
