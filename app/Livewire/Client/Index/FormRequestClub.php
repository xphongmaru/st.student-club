<?php

namespace App\Livewire\Client\Index;

use Illuminate\Support\Facades\Validator;
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

    #[Validate(as:'Mã bảo mật ')]
    public string $captcha = '';
    public string $captchaImage;

    public function render()
    {
        return view('livewire.client.index.form-request-club');
    }

    public function mount()
    {
        $this->generateCaptcha();
    }

    public function generateCaptcha(): void
    {
        $this->captchaImage = captcha_src('numeric') . '?' . rand();
    }

    public function store(){
        if(!Auth::check()){
            $this->dispatch('flashMessage', type: 'error', message: 'Bạn cần đăng nhập tài khoản để đăng câu lạc bộ');
            return;
        }
        $this->validate();

        $validator = Validator::make(
            ['captcha' => $this->captcha],
            ['captcha' => 'required|captcha'],
            ['captcha.required' => 'Vui lòng nhập mã xác thực', 'captcha.captcha' => 'Mã xác thực không đúng']
        );

        if ($validator->fails()) {
            $this->addError('captcha', $validator->errors()->first('captcha'));
            $this->dispatch('flashMessage', type: 'warning', message: $validator->errors()->first('captcha'));
            $this->generateCaptcha();
            return;
        }

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
        $this->reset(['name', 'field', 'thumbnail', 'description','captcha']);
        $this->generateCaptcha();
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
            'captcha' => 'required',
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
