<?php

namespace App\Livewire\Client\Account;

use App\Models\Club;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use App\Enums\StatusRequestClub;

class ClubInviteMember extends Component
{
    public function render()
    {
        $user = Auth::user();
        $invites = $user->clubInviteUsers()
            ->orderBy('created_at', 'desc')

            ->get();

        return view('livewire.client.account.club-invite-member',[
            'invites' => $invites,
        ]);
    }

    public function ApprovedInvite($id){
        $user = Auth::user();
        $invite = $user->clubInviteUsers()->find($id);
        if($invite == null){
            $this->dispatch('flashMessage',type:'warning', message: 'Lời mời không tồn tại');
            return;
        }
        if($invite->pivot->status == StatusRequestClub::Approved->value){
            $this->dispatch('flashMessage',type:'warning', message: 'Lời mời đã được chấp nhận trước đó');
            return;
        }
        if($invite->pivot->status == StatusRequestClub::Rejected->value){
            $this->dispatch('flashMessage',type:'warning', message: 'Lời mời đã bị từ chối trước đó');
            return;
        }
        $club = Club::query()->where('id', $invite->pivot->club_id)->first();
        $club->users()->attach($user);
        $club->members_count ++;
        $club->save();

        $invite->pivot->status = StatusRequestClub::Approved;
        $invite->pivot->save();
        $this->dispatch('flashMessage',type:'success', message: 'Bạn đã chấp nhận lời mời tham gia câu lạc bộ');
        $this->dispatch('refreshComponent');
    }

    public function RejectedInvite($id){

        $user = Auth::user();

        if($user == null){
            $this->dispatch('flashMessage',type:'warning', message: 'Người dùng không tồn tại');
            return;
        }
        $invite = $user->clubInviteUsers()->find($id);
        if($invite == null){
            $this->dispatch('flashMessage',type:'warning', message: 'Lời mời không tồn tại');
            return;
        }
        if($invite->status == StatusRequestClub::Rejected->value){
            $this->dispatch('flashMessage',type:'warning', message: 'Lời mời đã bị từ chối trước đó');
            return;
        }
        if($invite->status == StatusRequestClub::Approved->value){
            $this->dispatch('flashMessage',type:'warning', message: 'Lời mời đã được chấp nhận trước đó');
            return;
        }
        $invite->pivot->status = StatusRequestClub::Rejected;
        $invite->pivot->save();

        $this->dispatch('flashMessage',type:'success', message: 'Đã từ chối lời mời tham gia câu lạc bộ');
    }

    public function refreshComponent()
    {
        $this->render();
    }
}
