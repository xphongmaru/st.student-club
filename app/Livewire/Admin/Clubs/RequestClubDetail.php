<?php

namespace App\Livewire\Admin\Clubs;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\RequestClub;
use App\Enums\StatusRequestClub;
use App\Models\Club;
use App\Models\User;
use App\Enums\StatusClub;
use Illuminate\Support\Facades\Storage;
use App\Models\PermissionClub;

class RequestClubDetail extends Component
{
    public $club_id;
    public $full_name_user;
    public $status;
    public $statusNew;

    public $name;
    public $field;
    public $thumbnail;
    public $description;

    public function render()
    {
        $clubRequest = RequestClub::find($this->club_id);
        return view('livewire.admin.clubs.request-club-detail',
            compact('clubRequest')
        );
    }

    public function mount($id)
    {
        $this->club_id = $id;
        $clubRequest = RequestClub::query()->find($this->club_id);
        $this->name = $clubRequest->name;
        $this->field = $clubRequest->field_of_activity;
        $this->thumbnail = $clubRequest->thumbnail;
        $this->description = $clubRequest->description;
        $this->full_name_user = $clubRequest->user->full_name;
        $this->status = $clubRequest->status;
        $this->statusNew = $clubRequest->status;
    }

    public function update(){
        $clubRequest = RequestClub::query()->find($this->club_id);
        if($this->status == StatusRequestClub::Approved->value) {
            $this->dispatch('flashMessage', type: 'error', message: 'Bạn không thể thay đổi trạng thái câu lạc bộ đã được duyệt');
        }
        else if($this->statusNew == StatusRequestClub::Approved->value){
            $extension = pathinfo($clubRequest->thumbnail, PATHINFO_EXTENSION);
            $filename = pathinfo($clubRequest->thumbnail, PATHINFO_FILENAME);
            $dirname = pathinfo($clubRequest->thumbnail, PATHINFO_DIRNAME);

            // Tạo tên mới (ví dụ abc_copy.jpg)
            $newFilename = $filename . '_copy.' . $extension;
            $newPath = $dirname . '/' . $newFilename;

            // Copy ảnh
            Storage::disk('public')->copy($clubRequest->thumbnail, $newPath);

            //tạo câu lạc bộ
            Club::query()->create([
                'name' => $this->name,
                'thumbnail' => $newPath,
                'field_of_activity' => $this->field,
                'description' => $this->description,
                'owner_id'=> $clubRequest->user->id,
                'status' => StatusClub::Active->value,
                'members_count'=> 1
            ]);
            //tạo người dùng trong câu lạc bộ
            $club = Club::query()->where('name', $this->name)->first();
            $club->users()->attach([
                'user_id' => $clubRequest->user->id,
            ]);

            //tạo vai trò câu lạc bộ
            $role = $club->roleClubs()->create([
                'name' => 'Chủ tịch',
            ]);

            $permissionClub = PermissionClub::query()->get();
            foreach ($permissionClub as $permission) {
                $role->rolePermissionClubs()->attach([
                    'permission_club_id' => $permission->id,
                ]);
            }

            $club->roleClubs()->create([
                'name' => 'Thành viên',
            ]);

            //tạo người dùng trong vai trò câu lạc bộ
            $roleClub = $club->roleClubs()->where('name', 'Chủ tịch')->first();
            $roleClub->user()->attach([
                'user_id' => $clubRequest->user->id,
            ]);

            $clubRequest->update([
                'status' =>$this->statusNew,
            ]);
            session()->flash('success', 'Duyệt câu lạc bộ thành công.');
            return redirect()->route('admin.request-club.list');
        }
        else{
            $clubRequest->update([
                'status' =>$this->statusNew,
            ]);
            session()->flash('success', 'Cập nhật trạng thái câu lạc bộ thành công.');
            return redirect()->route('admin.request-club.list');
        }
    }
}
