<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-info"></i>
                Thông tin đơn đăng ký
            </div>

            <div class="card-body">
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0 10px; ">
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Tên thành viên:</span>
                            <span>{{$request->name}}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Mã sinh viên:</span>
                            <span>{{$request->code}}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Email:</span>
                            <span>{{$request->email!=null?$request->email:"<chưa xác định>"}}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Số điện thoại:</span>
                            <span>{{$request->phone_number}}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Giới tính:</span>
                            <span>{{$request->gender!=null?$request->gender:"<chưa xác định>"}}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Khoa:</span>
                            <span>{{$request->getFacultyName($request->faculty_id)}}</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <span class="fw-bold">Lớp:</span>
                            <span>{{$request->class}}</span>
                        </label>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label fw-bold">
                        Ưu điểm và nhược điểm: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <textarea type="text" class="form-control" readonly>{{$request->advantage_and_disadvantage}}</textarea>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label fw-bold">
                        Lý do tham gia: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <textarea type="text" class="form-control" readonly>{{$request->reason}}</textarea>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">
                        Trạng thái: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <select wire:model.live="newStatus" class="form-control select" data-minimum-results-for-search="Infinity">
                            @foreach(\App\Enums\StatusJoinClub::cases() as $status)
                                <option  value="{{ $status->value }}" class="" @selected($request->status == $status->value)>{{ $status->label() }}</option>
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
                <a href="{{route('admin.club.recruitment-member.list-request',['id'=> $club_id, 'recruitment_id'=>$recruitment_id])}}" type="button" class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
            </div>
        </div>
    </div>
</div>
