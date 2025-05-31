<div class="row">

    <div class="col-md-9">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-info"></i>
                Thông tin sự kiện
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">
                        Tên sự kiện: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="name" type="text" placeholder="Nhập vào tiêu đề bài viết" class="form-control  @error('name') is-invalid @enderror">
                        @error('name')
                        <label class="text-danger mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">
                        Ảnh đại diện: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="thumbnail" type="file" class="form-control  @error('thumbnail') is-invalid @enderror">
                        @error('thumbnail')
                        <label class="text-danger mt-1">{{ $message }}</label>
                        @enderror
                        <div wire:loading wire:target="thumbnail">
                            <label class="text-success">Đang tải ảnh...</label>
                        </div>
                    </div>
                    <div class="mt-2">
                        @if ($thumbnail)
                            <img src="{{ $thumbnail->temporaryUrl() }}" alt="New thumbnail" class="img-thumbnail" width="250">
                        @endif
                        @if ($oldThumbnail && !$thumbnail)
                            <img src="{{ asset('storage/'.$oldThumbnail) }}" alt="New thumbnail" class="img-thumbnail" width="250">
                        @endif
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">
                        Ảnh sự kiện: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="photos" type="file" class="form-control  @error('photos') is-invalid @enderror" multiple>
                        @error('photos')
                        <label class="text-danger mt-1">{{ $message }}</label>
                        @enderror
                        <div wire:loading wire:target="photos">
                            <label class="text-success">Đang tải ảnh...</label>
                        </div>
                    </div>
                    <div class="mt-2" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 10px;">
                        @foreach ($photos as $photo)
                            <div class="mt-2">
                                @if ($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" alt="New thumbnail" class="img-thumbnail" style="height: 160px; object-fit: cover; width: 100%;">
                                    <div>
                                        <button wire:click="removePhoto('{{ $loop->index }}')" class="btn btn-danger btn-sm mt-2"><i class="ph-trash"></i> Xóa</button>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                            @foreach ($oldPhotos as $photo)
                                <div class="mt-2">
                                    @if ($photo)
                                        <img src="{{asset('storage/'.$photo)}}" alt="New thumbnail" class="img-thumbnail" style="height: 160px; object-fit: cover; width: 100%;">
                                        <div>
                                            <button wire:click="removeOldPhoto('{{ $photo }}')" class="btn btn-danger btn-sm mt-2"><i class="ph-trash"></i> Xóa</button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">
                        Nội dung ngắn: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <textarea wire:model.live="description" type="text" placeholder="Nhập vào tiêu đề bài viết" class="form-control  @error('description') is-invalid @enderror">

                        </textarea>
                        @error('description')
                        <label class="text-danger mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">
                        Ngày diễn ra: <span class="text-danger">*</span>
                    </label>
                    <div>
                        <input wire:model.live="event_date" type="date" placeholder="Nhập vào tiêu đề bài viết" class="form-control  @error('event_date') is-invalid @enderror">
                        @error('event_date')
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
                <button wire:click="update" class="btn btn-primary" type="submit"><i class="ph-floppy-disk"></i>Lưu</button>
                <a href="{{ route('admin.club.event-index',['id'=>$club_id]) }}" type="button" class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
            </div>
            <div class="card-body d-flex align-items-center gap-1" style="padding-top: 0">
            </div>
        </div>
    </div>
</div>
