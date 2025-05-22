<?php

namespace App\Livewire\Admin\Clubs;

use App\Enums\StatusClub;
use App\Enums\StatusRequestClub;
use App\Models\Club;
use App\Models\PermissionClub;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\RequestClub as RequestClubModel;
use Livewire\WithPagination;

class RequestClub extends Component
{
    use WithPagination;
    protected $listeners = [
        'confirmDeleteRequestClub' => 'confirmDeleteRequestClub',
        'confirmApproveRequestClub' => 'confirmApproveRequestClub',
    ];

    public $requestClubId;
    public $search = '';

    public function render()
    {
        $requestClubs = RequestClubModel::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('field_of_activity', 'like', '%' . $this->search . '%')
            ->orWhere('status', 'like', '%' . StatusRequestClub::mapValue($this->search)->value . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(1);
        return view('livewire.admin.clubs.request-club',[
            'requestClubs' => $requestClubs,
        ]);
    }

    public function openDeleteModel($id){
        $this->requestClubId = $id;
        $this->dispatch('openModel',type: 'warning', title: 'Bạn có chắc chắn muốn xóa yêu cầu này không?', confirmEvent: 'confirmDeleteRequestClub');
    }

    public function confirmDeleteRequestClub()
    {
        $requestClub = RequestClubModel::query()->find($this->requestClubId);
        if ($requestClub->status == StatusRequestClub::Approved->value) {
            $this->dispatch('flashMessage', type: 'error', message: 'Yêu cầu đã được duyệt');
            return;
        }
        if ($requestClub) {
            $requestClub->delete();
            $this->dispatch('flashMessage', type: 'success', message: 'Xóa yêu cầu thành công');
        } else {
            $this->dispatch('flashMessage', type: 'error', message: 'Yêu cầu không tồn tại');
        }
    }

    public function openApproveModel($id){
        $this->requestClubId = $id;
        $this->dispatch('openModel',type: 'warning', title: 'Bạn có chắc chắn muốn duyệt yêu cầu này không?', confirmEvent: 'confirmApproveRequestClub');
    }

    public function confirmApproveRequestClub(){
        $clubRequest = RequestClubModel::query()->find($this->requestClubId);
        if ($clubRequest->status == StatusRequestClub::Approved->value) {
            $this->dispatch('flashMessage', type: 'error', message: 'Yêu cầu đã được duyệt');
            return;
        }
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
            'name' => $clubRequest->name,
            'thumbnail' => $newPath,
            'field_of_activity' => $clubRequest->field_of_activity,
            'description' => $clubRequest->description,
            'owner_id'=> $clubRequest->user->id,
            'status' => StatusClub::Active->value,
            'members_count'=> 1
        ]);
        //tạo người dùng trong câu lạc bộ
        $club = Club::query()->where('name', $clubRequest->name)->first();
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
            'status' => StatusRequestClub::Approved->value,
        ]);
        $this->dispatch('flashMessage', type: 'success', message: 'Duyệt yêu cầu thành công');
    }
    protected $paginationTheme = 'bootstrap';
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
