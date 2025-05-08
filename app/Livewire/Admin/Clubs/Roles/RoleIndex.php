<?php

namespace App\Livewire\Admin\Clubs\Roles;

use Illuminate\Pagination\Paginator;
use Livewire\Component;
use App\Models\RoleClub;
use Livewire\WithPagination;

class RoleIndex extends Component
{
    protected $listeners = [
        'confirmDeleteRole' => 'confirmDeleteRole',
    ];

    public $club_id;
    public $search = '';
    public $role_id;

    public function render()
    {
        $roles = RoleClub::query()
            ->where('club_id', $this->club_id)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.admin.clubs.roles.role-index',[
            'roles' => $roles
        ]);
    }

    public function boot()
    {
        Paginator::useBootstrap();
    }

    public function openDeleteModel($id)
    {
        $this->role_id = $id;
        $this->dispatch('openModel', type: 'warning', title: 'Bạn có chắc chắn muốn xóa chức vụ này không?', confirmEvent: 'confirmDeleteRole');
    }

    public function confirmDeleteRole(){
        if(!$this->role_id) {
            $this->dispatch('flashMessage', type: 'error', message: 'Chức vụ không tồn tại');
            return;
        }
        //Xóa người dùng đang sử dụng chức vụ này
        $role = RoleClub::query()->find($this->role_id);
        if ($role->user()->count() > 0) {
            $this->dispatch('flashMessage', type: 'error', message: 'Chức vụ đang được sử dụng không thể xóa.');
            return;
        }

        //xóa quyền
        $role->rolePermissionClubs()->detach();

        if ($role) {
            $role->delete();
            $this->dispatch('flashMessage', type: 'success', message: 'Xóa chức vụ thành công');
        } else {
            $this->dispatch('flashMessage', type: 'error', message: 'Chức vụ không tồn tại');
        }



    }
}
