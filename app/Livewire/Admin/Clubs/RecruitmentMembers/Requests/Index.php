<?php

namespace App\Livewire\Admin\Clubs\RecruitmentMembers\Requests;

use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Models\RequestMemberClub;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use App\Mail\AppointmentNotice;
use App\Models\User;
use App\Models\Club;
use App\Jobs\SendAppointmentNotice;
use App\Enums\StatusJoinClub;

class Index extends Component
{
    protected $listeners  =[
        'confirmDeleteRequest' => 'confirmDeleteRequest',
        'confirmAgreeRequest' => 'confirmAgreeRequest',
    ];
    use WithPagination;

    public $club_id;
    public $recruitment_id;
    public $search = '';
    public $deleteId;
    public $agreeId;

    public function render()
    {
        $requests = RequestMemberClub::query()
            ->where('recruitment_club_id', $this->recruitment_id)
            ->where('club_id', $this->club_id)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%')
                    ->orWhere('student_code', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('livewire.admin.clubs.recruitment-members.requests.index',[
            'requests' => $requests,
        ]);
    }

    public function mount()
    {
        $this->club_id = request()->id;
        $this->recruitment_id = request()->recruitment_id;

    }

    public function boot()
    {
        Paginator::useBootstrap();
    }

    public function openDeleteModel($id){
        $this->deleteId = $id;
        $this->dispatch('openModel',type: 'warning',title: 'Bạn có chắc chắn muốn xóa yêu cầu này không?',confirmEvent: 'confirmDeleteRequest');
    }

    public function confirmDeleteRequest(){
        $request = RequestMemberClub::query()->where('id', $this->deleteId)->first();
        $request->delete();
        $this->dispatch('flashMessage', type: 'success', message: 'Xóa yêu cầu thành công');
    }


    public function AgreeRequest($id)
    {
        $this->agreeId = $id;
        $this->dispatch('openModel',type: 'warning',title: 'Bạn có chắc chắn muốn duyệt đơn này không?',confirmEvent: 'confirmAgreeRequest', text: 'Khi duyệt đơn này sẽ thêm thành viên vào CLB, bạn sẽ không thể hoàn tác lại.');
    }

    public function confirmAgreeRequest()
    {
        $request = RequestMemberClub::query()
            ->where('id', $this->agreeId)
            ->where('recruitment_club_id', $this->recruitment_id)
            ->where('club_id', $this->club_id)
            ->first();
        if (!$request) {
            $this->dispatch('flashMessage', type: 'error', message: 'Yêu cầu không tồn tại');
            return;
        }
        elseif($request->status == StatusJoinClub::Approved->value){
            $this->dispatch('flashMessage', type: 'error', message: 'Yêu cầu đã được duyệt');
            return;
        }

        $request->status = StatusJoinClub::Approved->value;
        $request->save();

        $user = User::find($request->user_id);
        $club = Club::find($this->club_id);
        $club->users()->attach($user);
        $club->members_count ++;
        $club->save();

        $this->dispatch('flashMessage', type: 'success', message: 'Duyệt yêu cầu thành công');

    }
}
