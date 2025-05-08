<?php

namespace App\Livewire\Admin\Clubs\Roles;

use Livewire\Component;
use App\Models\RoleClub;
use App\Models\PermissionClub;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;

class RoleDetail extends Component
{
    public $club_id;
    public $role_id;

    public $permissions = [];
    public $role;

    #[validate(as: 'Tên chức vụ')]
    public $name;
    #[validate(as: 'quyền hạn')]
    public $permission_ids = [];

    public $old_permission_ids = [];
    public $new_permission_ids = [];


    public function render()
    {
        return view('livewire.admin.clubs.roles.role-detail',[
            'club_id' => $this->club_id,
            'role' => $this->role,
            'permissions' => $this->permissions,

        ]);
    }

    public function mount()
    {
        $this->permissions = PermissionClub::query()->get();
        $this->role = RoleClub::query()->where('id', $this->role_id)->first();
        if (!$this->role) {
            abort(404);
        }
        $this->name = $this->role->name;
        $this->permission_ids = $this->role->rolePermissionClubs()->pluck('permission_club_id')->toArray();
        $this->old_permission_ids = $this->permission_ids;
    }

    protected function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('role_clubs', 'name')
                    ->ignore($this->role_id)
                    ->where(function ($query) {
                        return $query->where('club_id', $this->club_id);
                    }),
            ],
            'permission_ids' => 'array',
        ];
    }

    public function update(){
        $this->validate();

        if($this->role->name=="Chủ tịch" && $this->name != "Chủ tịch"){
            $this->dispatch('flashMessage', message: 'Không thể sửa tên chức vụ Chủ tịch', type: 'error');
        }

        if($this->role->name=="Chủ tịch"){
            $tmp=0;
            foreach ($this->permission_ids as $permission_id) {
                $permission = PermissionClub::query()->where('id', $permission_id)->first();
                if ($permission->name == "Quản lý thành viên" || $permission->name == "Quản lý chức vụ") {
                    $tmp=$tmp+1;
                }
            }
            if($tmp!=2){
                $this->dispatch('flashMessage', message: 'Chức vụ Chủ tịch phải có quyền Quản lý thành viên và Quản lý chức vụ', type: 'error');
                return;
            }
        }

        $this->new_permission_ids = $this->permission_ids;
        if($this->new_permission_ids == $this->old_permission_ids){
            $this->dispatch('flashMessage', message: 'Bạn chưa có nội dung cần cập nhật.', type: 'warning');
            return;
        }

        $this->role->rolePermissionClubs()->detach();
        $this->role->rolePermissionClubs()->attach($this->new_permission_ids);

        session()->flash('success', 'Cập nhật chức vụ thành công');
        return redirect()->route('admin.club.role-index', ['id' => $this->club_id]);
    }


}
