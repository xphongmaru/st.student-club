<div>
    <div class="mt-2 d-flex gap-3">
        <input wire:model.live="newCategory" type="text" class="form-control  @error('newCategory') is-invalid @enderror" placeholder="Nhập tên danh mục mới">
        <button wire:click="store" class="btn btn-success" style="width: 230px"><i class="ph-floppy-disk"></i>Lưu danh mục</button>
    </div>
    @error('newCategory')
    <label class="text-danger mt-1">{{ $message }}</label>
    @enderror
</div>
