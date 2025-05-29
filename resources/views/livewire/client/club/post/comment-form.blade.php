<div class="d-flex mt--20 mb--25" style="margin-left: 20px">
    <img src=" {{ Auth::user()->thumbnail!=null?asset('storage/'.Auth::user()->thumbnail):asset('assets/client/images/user/default-user-image.png')}}" alt="" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover">
    <div class="" style="width: 90%">
        <form class="d-flex ms-4 flex-column" style="width: 100%; margin-top: 10px" wire:submit="submit">
            @csrf
            <textarea wire:model.live="content" placeholder="Viết bình luận" rows="2" style="padding: 10px" class="@error('content') is-invalid @enderror"></textarea>
            @error('content') <span class="text-danger">{{ $message }}</span> @enderror
            @isset($parentId)
                <input type="hidden" name="parent_id" value="{{ $parentId }}">
            @endisset

        <div class="d-flex justify-content-end" style="margin-top: 10px">
            <button type="submit" class="btn btn-default" style="line-height: 30px; height: 36px; padding: 0 15px">
                <i class='fa fa-send'></i> Gửi</button>
        </div>
        </form>
    </div>
</div>
