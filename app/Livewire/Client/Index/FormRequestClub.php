<?php

namespace App\Livewire\Client\Index;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\RequestClub as RequestClubModel;
use Illuminate\Support\Facades\Auth;
use App\Enums\StatusRequestClub;

class FormRequestClub extends Component
{
    use \Livewire\WithFileUploads;

    #[Validate(as: 'Tên câu lạc bộ')]
    public $name;
    #[Validate(as: 'Lĩnh vực hoạt động')]
    public $field;
    #[Validate(as: 'Logo câu lạc bộ')]
    public $thumbnail;
    #[Validate(as: 'Mô tả câu lạc bộ')]
    public $description;

    public function render()
    {
        return view('livewire.client.index.form-request-club');
    }

    public function store(){
        $this->validate();

        if(!Auth::check()){
            $this->dispatch('flashMessage', type: 'error', message: 'Bạn cần đăng nhập tài khoản để đăng câu lạc bộ');
        }
        if($this->thumbnail == null){
            $this->dispatch('flashMessage', type: 'error', message: 'Bạn cần chọn ảnh hồ sơ');
        }

        $thumbnailPath = $this->thumbnail->store('Clubs/Logo', 'public');
        RequestClubModel::create([
            'name' => $this->name,
            'field_of_activity' => $this->field,
            'thumbnail' => $thumbnailPath,
            'description' => $this->description,
            'user_id'=> Auth::user()->id,
            'status' => StatusRequestClub::Pending,
        ]);
        $this->dispatch('flashMessage', type: 'success', message: 'Đăng ký CLB thành công');
        $this->reset(['name', 'field', 'thumbnail', 'description']);
        $this->dispatch('closeModal');
    }

    public function removeThumbnail(){
        $this->thumbnail = null;
        $this->dispatch('flashMessage', type: 'success', message: 'Xóa ảnh thành công');
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:clubs,name',
            'field' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string|max:1000',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Tên câu lạc bộ không được để trống',
            'name.string' => 'Tên câu lạc bộ không hợp lệ',
            'name.max' => 'Tên câu lạc bộ không được quá 255 ký tự',
            'name.unique' => 'Tên câu lạc bộ đã tồn tại',
            'thumbnail.required' => 'Ảnh hồ sơ không được để trống',
            'thumbnail.image' => 'Ảnh hồ sơ phải là định dạng ảnh',
            'thumbnail.mimes' => 'Ảnh hồ sơ phải có định dạng jpeg, png, jpg',
            'thumbnail.max' => 'Ảnh hồ sơ không được quá 2MB',
        ];
    }
}
