<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-info"></i>
                Thông tin câu lạc bộ
            </div>

            <div class="card-body fs-6">
                <div class="form-group mt-2">
                    <label class="form-label">
                        <span class="fw-bold">Tên câu lạc bộ:</span>
                        <span>{{$club->name}}</span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <span class="fw-bold">Chủ tịch:</span>
                        <span>{{$club->getUser($club->owner_id)->full_name}}</span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <span class="fw-bold">Lĩnh vực hoạt động:</span>
                            <span>{{$club->field_of_activity!=null?$club->field_of_activity:"<trống>"}}</span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <span class="fw-bold">Ngày thành lập:</span>
                        <span>{{$club->foundation!=null?$club->foundation:"<trống>"}}</span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <span class="fw-bold">Số lượng thành viên:</span>
                        <span>{{$club->members_count}}</span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <span class="fw-bold">Email:</span>
                        <span>{{$club->email!=null?$club->email:"<trống>"}}</span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <span class="fw-bold">Số điện thoại:</span>
                        <span>{{$club->phone!=null?$club->phone:"<trống>"}}</span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <span class="fw-bold">Địa chỉ:</span>
                        <span>{{$club->address!=null?$club->address:"<trống>"}}</span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <span class="fw-bold">Slogan:</span>
                        <span>{{$club->slogan!=null?$club->slogan:"<trống>"}}</span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <span class="fw-bold">Mô tả:</span>
                        <span>{{$club->description!=null?$club->description:"<trống>"}}</span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <span class="fw-bold">Số bài viết:</span>
                        <span>{{$club->posts_count!=null?$club->posts_count:"0"}}</span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <span class="fw-bold">Số sự kiện:</span>
                        <span>{{$club->evens_count!=null?$club->evens_count:"0"}}</span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <span class="fw-bold">Số người theo dõi:</span>
                        <span>{{$club->followers_count!=null?$club->followers_count:"0"}}</span>
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <span class="fw-bold">Số người thích:</span>
                        <span>{{$club->likes_count!=null?$club->likes_count:"0"}}</span>
                    </label>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label fw-bold">
                        Ảnh logo CLB:
                    </label>
                    <div class="" style="background-color: rgba(0, 140, 255, 0.062); border-radius: 16px; padding: 16px 100px">
                        <img src="{{asset('storage/'.$club->thumbnail)}}" alt="" style="max-height: 200px; object-fit: cover;">
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label fw-bold">
                        Trạng thái:
                    </label>
                    <div>
                        <select wire:model.live="status" class="form-control select" data-minimum-results-for-search="Infinity">
                            @foreach(\App\Enums\StatusClub::cases() as $status)
                                <option  value="{{ $status->value }}" class="" @selected($club->status == $status->value)>{{ $status->label() }}</option>
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
                <a href="{{ route('admin.club.index') }}" type="button" class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
            </div>
            <div class="card-body d-flex align-items-center gap-1" style="padding-top: 0">
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#change_president" type="button" class="btn btn-info">Đổi chủ tịch câu lạc bộ</a>
            </div>

        </div>
    </div>
</div>
