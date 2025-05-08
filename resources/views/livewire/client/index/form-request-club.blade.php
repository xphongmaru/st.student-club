<div>
    <div class="modal-content">
        <div class="logo-mini">
            <img src="{{asset('assets\admin\images\logo_vnua.png')}}" alt="">
        </div>
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Đăng ký câu lạc bộ </h5>
            <a href="javascript:void(0)" data-bs-dismiss="modal" aria-label="Close">X</a>
        </div>
        <div class="quick-veiw-area">
            <div class="px-5 pt-3 pb-5">
                @if(!Auth()->check())
                    <div class="alert alert-danger" role="alert">
                        Bạn cần đăng nhập để đăng ký câu lạc bộ
                    </div>
                @endif

                <form class="contact-form-1 rainbow-dynamic-form" wire:submit="store">
                    <div class="form-group">
                        <label class="mb-2">Tên câu lạc bộ: <span>*</span> </label>
                        <input type="text" wire:model.live="name" class="@error('name') is-invalid @enderror" placeholder="Nhập vào tên câu lạc bộ">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Lĩnh vực hoạt động: <span>*</span></label>
                        <input type="text" wire:model.live="field" class="@error('field') is-invalid @enderror" placeholder="Nhập vào lĩnh vực hoạt động của CLB">
                        @if ($errors->has('field'))
                            <span class="text-danger">{{ $errors->first('field') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Logo/Avatar câu lạc bộ:<span>*</span></label>
                        <div class="actions">
                            <label for="file" class="button upload-btn @error('thumbnail') is-invalid @enderror">Chọn hình ảnh
                                <input hidden="" wire:model.live="thumbnail" type="file" id="file" accept="image/jpeg,image/png,image/jpg">
                            </label>
                            <div wire:loading wire:target="thumbnail" class="mt-3" style="margin-left: 15px; color: var(--color-vnua); font-size: 16px; font-weight: 500" >
                                Đang tải lên...
                            </div>
                            <div wire:loading wire:target="thumbnail">
                                <button type="button" class="btn-default btn-small mt-3" x-on:click="$wire.cancelUpload('thumbnail')" style="padding:0 10px ; height: 30px; line-height: 27px">Hủy</button>
                            </div>

                        </div>
                        @if ($thumbnail)
                            @if (Str::startsWith($thumbnail->getMimeType(), 'image/'))
                                <div class="result">
                                    <div class="file-uploaded ps-4">
                                        <img src="{{ $thumbnail->temporaryUrl() }}" alt="Preview file" style="max-height: 230px">
                                    </div>
                                    <div class="remove-thumbnail" wire:click="removeThumbnail">X</div>
                                </div>
                            @endif
                        @endif
                        @if ($errors->has('thumbnail'))
                                <span class="text-danger">{{ $errors->first('thumbnail') }}</span>
                            @endif
                        </div>

                    <div class="form-group">
                        <label class="mb-2">Mô tả câu lạc bộ: <span>*</span></label>
                        <textarea wire:model.live="description" class="@error('description') is-invalid @enderror" placeholder="Nhập vào mô tả câu lạc bộ"></textarea>
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <button name="submit" type="submit" id="submit" class="btn-default btn-small  rainbow-btn">
                            <span>Đăng ký CLB</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
