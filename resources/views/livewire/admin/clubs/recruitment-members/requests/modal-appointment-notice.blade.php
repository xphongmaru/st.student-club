<div>
    <div class="modal-content" id="changePresidentModal">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thông tin hẹn phỏng vấn</h5>
            <a href="javascript:void(0)" data-bs-dismiss="modal" aria-label="Close">X</a>
        </div>
        <div class="quick-veiw-area">
            <div class="text-danger pt-2 text-center">Chỉ gửi thông báo lịch hẹn cho các đơn ở trạng thái <strong class="badge bg-danger">đang xem xét</strong>.</div>
            <div class="px-5 pt-2 pb-3">
                <form class="contact-form-1 rainbow-dynamic-form" id="contact-form" wire:submit.prevent="AppointmentNotice" action="">
                    <div class="form-group">
                        <label class="form-label fw-bold">
                            Địa điểm: <span class="text-danger">*</span>
                        </label>
                        <div>
                            <input wire:model.live="address" type="text" placeholder="Nhập vào địa điểm phỏng vấn " class="form-control  @error('address') is-invalid @enderror">
                            @error('address')
                            <label class="text-danger mt-1">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label fw-bold">
                            Thời gian: <span class="text-danger">*</span>
                        </label>
                        <div>
                            <input wire:model.live="dateTime" type="text" placeholder="Nhập vào thời gian phỏng vấn" class="form-control  @error('dateTime') is-invalid @enderror">
                            @error('dateTime')
                            <label class="text-danger mt-1">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label fw-bold">
                            Hình thức:
                        </label>
                        <div>
                            <input wire:model.live="content" type="text" placeholder="Nhập vào hình thức phỏng vấn" class="form-control  @error('content') is-invalid @enderror">
                            @error('content')
                            <label class="text-danger mt-1">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label fw-bold">
                            Ghi chú:
                        </label>
                        <div>
                            <textarea wire:model.live="note" placeholder="Nhập vào ghi chú thêm" class="form-control  @error('note') is-invalid @enderror"></textarea>
                            @error('note')
                            <label class="text-danger mt-1">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary">
                            <span> Gửi lịch hẹn </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
