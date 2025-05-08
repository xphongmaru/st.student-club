<?php

namespace App\Livewire\Client\Club;

use Livewire\Attributes\Validate;
use Livewire\Component;

class ModalUpdate extends Component
{
    public $club;
    #[Validate(as: 'Slogan')]
    public $slogan;
    #[Validate(as: 'Lĩnh vực hoạt động')]
    public $field;
    #[Validate(as: 'Mô tả câu lạc bộ')]
    public $description;
    #[Validate(as: 'Địa chỉ')]
    public $address;
    #[Validate(as: 'Ngày thành lập CLB')]
    public $foundation_date;
    #[Validate(as: 'Điện thoại')]
    public $phone;
    #[Validate(as: 'Email')]
    public $email;


    public function render()
    {
        return view('livewire.client.club.modal-update');
    }

    public function mount($club){
        $this->club = $club;
        $this->slogan = $club->slogan;
        $this->field = $club->field_of_activity;
        $this->description = $club->description;
        $this->address = $club->address;
        $this->foundation_date = $club->foundation_date;
        $this->phone = $club->phone;
        $this->email = $club->email;
    }

    public function store(){
        $this->validate();
        $this->club->slogan = $this->slogan;
        $this->club->field_of_activity = $this->field;
        $this->club->description = $this->description;
        $this->club->address = $this->address;
        $this->club->foundation_date = $this->foundation_date;
        $this->club->phone = $this->phone;
        $this->club->email = $this->email;
        $this->club->save();
        $this->dispatch('flashMessage', type: 'success', message: 'Cập nhật thông tin câu lạc bộ thành công');
        $this->dispatch('refreshPage');
    }


    protected function rules()
    {
        return [
            'slogan' => 'string|max:255',
            'field' => 'required|string|max:255',
            'description' => 'required|string|max:1024',
            'address' => 'string|max:255',
            'foundation_date' => 'date|after:1900-01-01|before:today',
            'phone' => 'string|regex:/^0[0-9]{9,14}$/',
            'email' => 'email|max:255',
        ];
    }

    protected function messages(){
        return [
            'foundation_date.date' => 'Ngày thành lập không hợp lệ',
            'foundation_date.after' => 'Ngày thành lập không hợp lệ',
            'foundation_date.before' => 'Ngày thành lập phải là ngày trong quá khứ',
        ];
    }
}
