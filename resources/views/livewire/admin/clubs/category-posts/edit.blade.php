<div class="row">

    <div class="col-md-9">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-info"></i>
                Thông tin danh mục bài viết
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">
                        Tên danh mục: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="name" type="text" placeholder="Nhập vào tên danh mục bài viết " class="form-control  @error('name') is-invalid @enderror">
                        @error('name')
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
            <div class="card-body d-flex flex-wrap align-items-center gap-1">
                <button wire:click="update" class="btn btn-primary" type="submit"><i class="ph-floppy-disk"></i>Tạo mới</button>
                <a href="{{ route('admin.club.category-post.index',['id'=>$club_id]) }}" type="button" class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
            </div>
            <div class="card-body d-flex align-items-center gap-1" style="padding-top: 0">
            </div>
        </div>
    </div>
</div>
