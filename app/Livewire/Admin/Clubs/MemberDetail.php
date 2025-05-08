<?php

namespace App\Livewire\Admin\Clubs;

use App\Models\Member;
use Livewire\Component;
use App\Models\User;
use App\Models\RoleClub;

class MemberDetail extends Component
{
    protected $listeners = ['confirmChange'=>'confirmChange'];

    public $club_id;
    public $member_id;
    public $member;
    public $roleClubs;
    public $oldRoleClubs;
    public $newRoleClub;
    public $roleClub;

    public function render()
    {
        $this->roleClubs = RoleClub::query()->where('club_id', $this->club_id)->get();
        $this->member = User::find($this->member_id);
        $this->oldRoleClubs = $this->member->getRoleClub($this->club_id, $this->member_id);
        $roleClub = $this->member->getRoleClub($this->club_id, $this->member_id);
        if($roleClub){
            $this->roleClub = $roleClub->id;
        }
        else{
            $this->roleClub = null;
        }
        return view('livewire.admin.clubs.member-detail',[
            'member' => $this->member,
            'roleClubs' => $this->roleClubs,
            'club_id' => $this->club_id,
            'oldRoleClubs' => $this->oldRoleClubs,
        ]);
    }

    public function update()
    {
        $this->newRoleClub = $this->roleClub;

        if ($this->newRoleClub === null) {
            $this->dispatch('flashMessage', type: "warning", message: "Chưa có thông tin cập nhật.");
            return;
        }

        if ($this->oldRoleClubs !== null) {
            if ($this->newRoleClub == $this->oldRoleClubs->id) {
                $this->dispatch('flashMessage', type: "warning", message: "Chưa có thông tin cập nhật.");
                return;
            }

            if ($this->oldRoleClubs->name === "Chủ tịch") {
                $this->dispatch('flashMessage', type: "error", message: "Chức vụ hiện tại của bạn là 'Chủ tịch' không thể thay đổi.");
                return;
            }
        }

        $newRole = RoleClub::find($this->newRoleClub);
        if ($newRole && $newRole->name === "Chủ tịch") {
            $this->dispatch('flashMessage', type: "error", message: "Câu lạc bộ chỉ có 1 chủ tịch.");
            return;
        }

        $this->dispatch('openModel', type: 'warning', title: 'Bạn có chắc chắn muốn thay đổi chức vụ cho thành viên này không?', confirmEvent: 'confirmChange');
    }


    public function confirmChange()
    {
        if($this->oldRoleClubs==null){
            $this->member->roleClubs()->attach(['role_club_id' => $this->newRoleClub]);
            session()->flash('success', 'Cập nhật thành công chức vụ cho thành viên này.');
            return redirect()->route('admin.club.member-index', $this->club_id);
        }

        $role = $this->member->roleClubs()->updateExistingPivot($this->oldRoleClubs->id,
            ['role_club_id' => $this->newRoleClub]);
        if($role){
            session()->flash('success', 'Cập nhật thành công chức vụ cho thành viên này.');
            return redirect()->route('admin.club.member-index', $this->club_id);
        }
        else{
            session()->flash('error', 'Cập nhật không thành công chức vụ cho thành viên này.');
            return redirect()->route('admin.club.member-index', $this->club_id);
        }
    }
}
