<div>
    <div class="modal-content" id="changePresidentModal">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Đổi chủ tịch câu lạc bộ</h5>
            <a href="javascript:void(0)" data-bs-dismiss="modal" aria-label="Close">X</a>
        </div>
        <div class="quick-veiw-area">
            <div class="px-5 pt-3 pb-5">
                <form class="contact-form-1 rainbow-dynamic-form" id="contact-form" wire:submit.prevent="changePresidentClub" action="">
                    <div class="form-group" wire:ignore>
                        <label class="mb-2 fs-6"> Tên thành viên: <span>*</span></label>
                        <select wire:model.live="user_id" id="selectCLB" class="select2" onchange="@this.set('user_id', this.value)">
                            <option class="placeholder fs-6" selected value="0">Chọn 1 thành viên</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->full_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            <span> Chuyển quyền chủ tịch </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
