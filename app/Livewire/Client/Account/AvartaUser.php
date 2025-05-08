<?php

namespace App\Livewire\Client\Account;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class AvartaUser extends Component
{
    use WithFileUploads;

    #[Validate(as:'ảnh đại diện')]
    public $avatar;

    public function render()
    {
        $user = auth()->user();
        return view('livewire.client.account.avarta-user',[
            'user' => $user,
        ]);
    }

    public function removeAvatar(){
        $this->avatar = null;
    }

    public function updateAvatar()
    {
        $this->validate([
            'avatar' => 'image|max:1024', // 1MB Max
        ]);

        if ($this->avatar) {
            //xóa ảnh cũ
            if (auth()->user()->thumbnail) {
                $oldImagePath = public_path('storage/' . auth()->user()->thumbnail);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $avatarPath = $this->avatar->store('Users/Avatar', 'public');
            auth()->user()->thumbnail = $avatarPath;
        }
        auth()->user()->save();
        $this->avatar = null;
        $this->dispatch('flashMessage', type:'success', message: 'Cập nhật ảnh đại diện thành công');

    }

    protected function rules(){
        return [
            'avatar' => 'image|max:1024 ', // 1MB Max
        ];
    }
}
