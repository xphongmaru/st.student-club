<div>
    <div class="modal-content" id="changePresidentModal">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Lên lịch đăng bài</h5>
            <a href="javascript:void(0)" data-bs-dismiss="modal" aria-label="Close">X</a>
        </div>
        <div class="quick-veiw-area">
            <div class="px-5 pt-3 pb-5">
                <div class="form-group">
                    <div>
                        <div class="d-flex">
                            <input wire:model.live="datetime" type="datetime-local" class="form-control  @error('datetime') is-invalid @enderror">
                        </div>
                        @error('datetime')
                        <label class="text-danger mt-1">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="form-group d-flex justify-content-center mt-3">
                    <button wire:click="store" class="btn btn-primary">
                        <span> <i class="ph-floppy-disk"></i> Xác nhận </span>
                    </button>
                    <button wire:click="resetDate" class="ms-3 btn btn-info">
                        <span><i class="ph-repeat"></i> Đặt lại </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
