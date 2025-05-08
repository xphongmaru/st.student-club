<?php

namespace App\Livewire\Admin\Clubs;

use Livewire\Component;
use App\Models\Club;
use App\Models\User;

class ModalChangePresident extends Component
{
    protected $listeners = ['confirmChangePresident' => 'confirmChangePresident'];
    public $club_id;
    public $club;
    public $users = [];
    public $user_id;
    public function render()
    {
        return view('livewire.admin.clubs.modal-change-president',[
            'users'=>$this->users,
        ]);
    }

    public function mount($club_id)
    {
        $this->club_id = $club_id;
        $this->club = Club::query()->find($this->club_id);
        $this->users = $this->club->users()->get();
    }


    public function changePresidentClub(){
        if ($this->club_id == null || $this->user_id == 0) {
            $this->dispatch('flashMessage', type: 'error', message: 'Thành viên không tồn tại, vui lòng thử lại!');
            return;
        }
        else if($this->user_id == $this->club->owner_id){
            $this->dispatch('flashMessage', type: 'error', message: 'Thành viên này đã là chủ tịch CLB!');
            return;
        }
        else{
            $this->dispatch('openModel', type: 'warning', title: 'Bạn có chắc chắn muốn thay đổi chủ tịch CLB này không?', confirmEvent: 'confirmChangePresident');
        }
    }

    public function confirmChangePresident()
    {
        // Cập nhật owner_id của câu lạc bộ
        $oldOwner =User::query()->find($this->club->owner_id);
        $this->club->update([
            'owner_id' => $this->user_id,
        ]);

        // Cập nhật user_id của vai trò Chủ tịch trong câu lạc bộ
        $roleClub = $this->club->roleClubs()->where('name', 'Chủ tịch')->first();
        if (!$roleClub) {
            $this->dispatch('flashMessage', type: 'error', message: 'Không tìm thấy vai trò Chủ tịch trong câu lạc bộ này.');
            return;
        }
        $oldOwner->roleClubs()->detach($roleClub->id);
        $user = User::query()->find($this->user_id);
        $user->roleClubs()->detach($roleClub->id);
        $user->roleClubs()->attach($roleClub->id);

        $this->dispatch('flashMessage', type: 'success', message: 'Đổi chủ tịch CLB thành công!');
        $this->dispatch('presidentChanged');
    }

}
