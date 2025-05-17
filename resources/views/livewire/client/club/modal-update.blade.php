<div>
    <div class="modal-content">
        <div class="logo-mini">
            <img src="{{asset('assets\admin\images\logo_vnua.png')}}" alt="">
        </div>
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa thông tin câu lạc bộ </h5>
            <a href="javascript:void(0)" data-bs-dismiss="modal" aria-label="Close">X</a>
        </div>
        <div class="quick-veiw-area">
            <div class="px-5 pt-3 pb-5">
                <form class="contact-form-1 rainbow-dynamic-form" wire:submit="store">
                    <div class="form-group">
                        <label class="mb-2">Tên câu lạc bộ: {{$club->name}}</label>
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Slogan: </label>
                        <input type="text" wire:model.live="slogan" class="@error('slogan') is-invalid @enderror" placeholder="Nhập vào slogan của CLB">
                        @if ($errors->has('slogan'))
                            <span class="text-danger">{{ $errors->first('slogan') }}</span>
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
                        <label class="mb-2">Địa chỉ:</label>
                        <input type="text" wire:model.live="address" class="@error('address') is-invalid @enderror" placeholder="Nhập vào địa chỉ của CLB">
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Email:</label>
                        <input type="text" wire:model.live="email" class="@error('email') is-invalid @enderror" placeholder="Nhập vào địa chỉ của CLB">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Số điện thoại:</label>
                        <input type="text" wire:model.live="phone" class="@error('phone') is-invalid @enderror" placeholder="Nhập vào địa chỉ của CLB">
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Ngày thành lập:</label>
                        <input type="date" wire:model.live="foundation_date" class="@error('foundation_date') is-invalid @enderror" placeholder="Nhập vào địa chỉ của CLB">
                        @if ($errors->has('foundation_date'))
                            <span class="text-danger">{{ $errors->first('foundation_date') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Mô tả câu lạc bộ: <span>*</span></label>
                        <textarea wire:model.live="description" class="@error('description') is-invalid @enderror" placeholder="Nhập vào mô tả câu lạc bộ"></textarea>
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                    {{--liên kết--}}
                    <div class="form-group">
                        <label class="mb-2">Các trang web và liên kết mạng xã hội:</label>
                        <a wire:click="addComponent" class="btn-default btn-small btn-add-link rainbow-btn">
                            <span>Thêm</span>
                        </a>
                        @foreach($components as $index)
                            <livewire:client.club.cpn-link-web :key="$index" :id="$index" :club="$club"/>
                        @endforeach

                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <button name="submit" type="submit" id="submit" class="btn-default btn-small  rainbow-btn">
                            <span>Cập nhật</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
