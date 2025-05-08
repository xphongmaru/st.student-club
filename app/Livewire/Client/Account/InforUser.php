<?php

namespace App\Livewire\Client\Account;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Faculty;

class InforUser extends Component
{
    #[Validate(as:'email')]
    public $email;

    #[Validate(as:'số điện thoại')]
    public $phone;

    #[Validate(as:'Lớp')]
    public $class;

    #[Validate(as:'Khoa')]
    public $faculty;

    #[Validate(as:'Ngày sinh')]
    public $birthday;

    #[Validate(as:'Giới tính')]
    public $gender;

    #[Validate(as:'Đia chỉ')]
    public $address;

    public function render()
    {
        $faculties = Faculty::all();
        return view('livewire.client.account.infor-user',[
            'user' => auth()->user(),
            'faculties' => $faculties,
        ]);
    }

    public function mount()
    {
        $user = auth()->user();
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->class = $user->class_name;
        $this->faculty = $user->faculty_id;
        $this->birthday = $user->date_of_birth;
        $this->gender = $user->gender;
        $this->address = $user->address;
    }

    protected function rules(){
        return [
            'email' => 'required|email',
            'phone' => 'nullable|regex:/^0[0-9]{0,14}$/',
            'class' => '',
            'faculty' => '',
            'birthday' => '',
        ];
    }

    public function changeInfo()
    {
        $this->validate();
        if($this->faculty==null || $this->faculty==0){
            $this->dispatch('flashMessage', type:'warning', message: 'Vui lòng chọn khoa');
            return;
        }
        $user = auth()->user();
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->class_name = $this->class;
        $user->faculty_id = $this->faculty;
        $user->date_of_birth = $this->birthday;
        $user->gender = $this->gender;
        $user->address = $this->address;
        $user->save();
        $this->dispatch('flashMessage', type:'success', message: 'Cập nhật thông tin thành công');
    }
}
