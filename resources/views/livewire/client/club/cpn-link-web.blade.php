<div class="mt-3">
    <div class="input-link">
        <select wire:model="icon_id" name="icon_id" onchange="@this.set('icon_id', this.value)">
            <option selected value="0">Chọn icon</option>
            @foreach($icons as $icon)
                <option value="{{$icon->id}}">{{$icon->name}}</option>
            @endforeach
        </select>
        @if($thumbnail!= null) <img src="{{asset($thumbnail)}}" alt="" class="icon-img"> @endif
        <input type="text" wire:model.live="url" class="@error('url') is-invalid @enderror" placeholder="Nhập vào địa chỉ của CLB">
        <div style="line-height: 45px; margin-left: 10px">
            <a wire:click="RemoveComponent" class="btn-default btn-small btn-add-link rainbow-btn">
                <span>Xóa</span>
            </a>
        </div>
    </div>
    @if ($errors->has('icon_id'))
        <span class="text-danger">{{ $errors->first('icon_id') }}</span>
    @endif
    @if ($errors->has('url'))
        <div class="text-danger">{{ $errors->first('url') }}</div>
    @endif

</div>
