<?php

namespace App\Livewire\Admin\Clubs\Roles;

use App\Models\Permission;
use Livewire\Component;
use App\Models\PermissionClub;
use Livewire\Attributes\Validate;
use App\Models\RoleClub;

class RoleCreate extends Component
{
    public $club_id;
    public $permissions;

    #[Validate(as: 'Tên chức vụ')]
    public $name;
    #[Validate(as: 'quyền hạn')]
    public $permission_ids=[];

    public function render()
    {
        $this->permissions = PermissionClub::all();
        return view('livewire.admin.clubs.roles.role-create',[
            'club_id' => $this->club_id,
            'permissions' => $this->permissions,
        ]);
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:role_clubs,name',
            'permission_ids' => 'array',
        ];
    }

    public function store()
    {
        $this->validate();
        $role = RoleClub::create([
            'club_id' => $this->club_id,
            'name' => $this->name,
        ]);
        $role->rolePermissionClubs()->attach($this->permission_ids);
        session()->flash('success', 'Thêm chức vụ thành công');
        return redirect()->route('admin.club.role-index', ['id' => $this->club_id]);

    }

}
