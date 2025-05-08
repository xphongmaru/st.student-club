<?php

namespace App\Livewire\Admin\Clubs\RecruitmentMembers\Requests;

use App\Enums\StatusJoinClub;
use App\Jobs\SendAppointmentNotice;
use App\Models\RequestMemberClub;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ModalAppointmentNotice extends Component
{
    public $club_id;
    public $recruitment_id;

    #[Validate(as: 'Địa điểm phỏng vấn')]
    public $address;

    #[Validate(as: 'Thời gian phỏng vấn')]
    public $dateTime;

    #[Validate(as: 'Hình thức phỏng vấn')]
    public $content;

    #[Validate(as: 'Ghi chú')]
    public $note;

    public function render()
    {
        return view('livewire.admin.clubs.recruitment-members.requests.modal-appointment-notice');
    }

    public function AppointmentNotice()
    {
        $this->validate();
        $requests = RequestMemberClub::query()
            ->where('recruitment_club_id', $this->recruitment_id)
            ->where('club_id', $this->club_id)
            ->where('status', StatusJoinClub::In_review->value)
            ->get();
        if($requests->isEmpty()){
            $this->dispatch('flashMessage',type: 'warning', message: 'Không có yêu cầu nào để gửi thông báo phỏng vấn');
            return;
        }
        $sender_id = auth()->user()->id;
        foreach ($requests as $request) {
            $receiver_id =$request->user_id;
            $club_id = $request->club_id;
            $request_id = $request->id;
            SendAppointmentNotice::dispatch(
                $sender_id,
                $receiver_id,
                $this->address,
                $this->dateTime,
                $this->content,
                $club_id,
                $request_id,
                $this->note
            );
        }
        $this->address= '';
        $this->dateTime= '';
        $this->content= '';
        $this->note= '';
        $this->dispatch('flashMessage',type: 'success', message: 'Gửi thông báo phỏng vấn thành công.');
    }

    protected function rules(){
        return [
            'address' => 'required|string|max:255',
            'dateTime' => 'required|string|max:255',
            'note' => 'nullable|string|max:500',
        ];
    }
}
