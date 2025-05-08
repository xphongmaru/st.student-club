<div class="profile d-flex">
    <div class="avatar">
        <img src="{{$user->thumbnail==null?asset('assets/client/images/user/default-user-image.png'):asset('storage/'.$user->thumbnail)}}" alt="{{$user->thumbnail==null?'default-user-image.png':asset('storage/'.$user->thumbnail)}}">
        <label for="avatar" class="avatar_edit w-100 @error('avatar') is-invalid @enderror"><span><i class='fa fa-edit'></i> Thay ảnh</span>
            <input hidden="" wire:model="avatar" type="file" id="avatar" accept="image/jpeg,image/png,image/jpg">
        </label>
        @if ($avatar)
            @if (Str::startsWith($avatar->getMimeType(), 'image/'))
                <div class="avatar_result">
                    <div class="file-uploaded">
                        <img src="{{ $avatar->temporaryUrl() }}" alt="Preview file" style="max-height: 230px">
                    </div>
                    <div class="remove-thumbnail" wire:click="removeAvatar">X</div>

                </div>
            @endif
        @endif
    </div>
    <div class="ms-4 d-flex flex-column justify-content-center">
        <span class="fs-2 text-success fw-bold">{{$user->full_name}}</span>
        <span class="ms-2">Mã SV: {{$user->code}}</span>
        @if ($avatar)
            @if (Str::startsWith($avatar->getMimeType(), 'image/'))
                <button wire:click="updateAvatar" class="btn btn-default btn-icon mt-3" style="padding:0 5px ; height: 36px; line-height: 30px">
                    <span>Lưu</span>
                </button>
            @endif
        @endif
        <div wire:loading wire:target="avatar" class="mt-3" style="margin-left: 15px; color: var(--color-vnua); font-size: 16px; font-weight: 500" >
            Đang tải lên...
        </div>
        <div wire:loading wire:target="avatar">
            <button type="button" class="btn-default btn-small mt-3" x-on:click="$wire.cancelUpload('banner')" style="padding:0 10px ; height: 30px; line-height: 27px">Hủy</button>
        </div>
    </div>
</div>
