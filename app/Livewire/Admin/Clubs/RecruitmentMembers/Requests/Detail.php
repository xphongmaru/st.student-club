<?php

namespace App\Livewire\Admin\Clubs\RecruitmentMembers\Requests;

use App\Enums\StatusJoinClub;
use App\Models\Club;
use Livewire\Component;
use App\Models\RequestMemberClub;
use App\Models\User;

class Detail extends Component
{
    protected $listeners = [
        'confirmUpdateRequest' => 'confirmUpdateRequest',
    ];
    public $club_id;
    public $recruitment_id;
    public $request_id;
    public $request;
    public $oldStatus;
    public $status;
    public $newStatus;

    public function render()
    {
        return view('livewire.admin.clubs.recruitment-members.requests.detail',[
            'request' => $this->request,
        ]);
    }
    public function mount()
    {
        $this->request = RequestMemberClub::query()
            ->where('id', $this->request_id)
            ->where('recruitment_club_id', $this->recruitment_id)
            ->where('club_id', $this->club_id)
            ->first();
        $this->oldStatus = $this->request->status;
        $this->newStatus = $this->request->status;
    }

    public function update()
    {
        $this->status = $this->newStatus;
        if($this->oldStatus == $this->status){
            $this->dispatch('flashMessage', type: 'warning', message: 'Không có thay đổi nào được thực hiện');
            return;
        }
        if($this->oldStatus == StatusJoinClub::Approved->value){
            $this->dispatch('flashMessage', type: 'warning', message: 'Không thể thay đổi trạng thái yêu cầu đã được duyệt');
            return;
        }
        if($this->status == StatusJoinClub::Approved->value){
            $this->dispatch('openModel', type: 'warning', title: 'Bạn có chắc chắn muốn duyệt yêu cầu này không?', confirmEvent: 'confirmUpdateRequest', text:' Khi duyệt yêu cầu này sẽ thêm thành viên vào CLB, bạn sẽ không thể hoàn tác lại.');
            return;
        }

        $request = RequestMemberClub::query()
            ->where('id', $this->request_id)
            ->where('recruitment_club_id', $this->recruitment_id)
            ->where('club_id', $this->club_id)
            ->first();
        $request->status = $this->status;
        $request->save();

        session()->flash('success', 'Cập nhật trạng thái thành công');
        return redirect()->route('admin.club.recruitment-member.list-request', [
            'id' => $this->club_id,
            'recruitment_id' => $this->recruitment_id,
        ]);
    }

    public function confirmUpdateRequest()
    {
        $request = RequestMemberClub::query()
            ->where('id', $this->request_id)
            ->where('recruitment_club_id', $this->recruitment_id)
            ->where('club_id', $this->club_id)
            ->first();
        $request->status = $this->status;
        $request->save();

        $user = User::find($request->user_id);
        $club = Club::find($this->club_id);
        $club->users()->attach($user);

        session()->flash('success', 'Duyệt đơn thành công');
        return redirect()->route('admin.club.recruitment-member.list-request', [
            'id' => $this->club_id,
            'recruitment_id' => $this->recruitment_id,
        ]);

    }
}
