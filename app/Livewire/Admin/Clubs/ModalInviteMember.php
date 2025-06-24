<?php

namespace App\Livewire\Admin\Clubs;

use Livewire\Component;
use App\Models\User;
use App\Models\Club;
use App\Enums\StatusRequestClub;
use App\Models\Notification;

class ModalInviteMember extends Component
{
    protected $listeners = ['resendInvite' => 'resendInvite'];

    public $club_id;
    public $user_id;
    public $content='Chúng tôi rất vui được mời bạn tham gia Câu lạc bộ';

    public function render()
    {
        $users = User::query()
            ->whereDoesntHave('clubs', function ($query) {
                $query->where('club_user.club_id', $this->club_id);
            })
            ->where('status', 'active')
            ->where('id', '!=', auth()->user()->id)
            ->orderBy('full_name', 'asc')
            ->get();
        return view('livewire.admin.clubs.modal-invite-member',[
            'users' => $users,
        ]);
    }

    public function Invite()
    {
        if($this->user_id == null || $this->user_id == 0){
            $this->dispatch('flashMessage',type:'warning', message: 'Vui lòng chọn người dùng để mời');
            return;
        }

        $club = Club::query()->where('id', $this->club_id)->first();
        if($club == null){
            $this->dispatch('flashMessage',type:'warning', message: 'Câu lạc bộ không tồn tại');
            return;
        }
        $user = User::query()->where('id', $this->user_id)->first();
        if($user == null){
            $this->dispatch('flashMessage',type:'warning', message: 'Người dùng không tồn tại');
            return;
        }
        //kiểm tra người dùng đã là thành viên của câu lạc bộ chưa
        if($club->users()->where('user_id', $user->id)->exists()){
            $this->dispatch('flashMessage',type:'warning', message: 'Người dùng đã là thành viên của câu lạc bộ');
            return;
        }
        if($club->clubInviteUsers()->where('user_id', $user->id)->exists()){
            if($club->clubInviteUsers()->where('user_id', $user->id)->first()->pivot->status == StatusRequestClub::Rejected->value){
                $this->dispatch('openModel' ,type:'warning' , title: 'Lời mời đã bị từ chối', text: 'Bạn có muốn gửi lại lời mời đến người dùng này không?', confirmEvent: 'resendInvite');
                return;
            }

            if($club->clubInviteUsers()->where('user_id', $user->id)->first()->pivot->status == StatusRequestClub::Approved->value){
                $this->resendInvite();
                return;
            }

            $this->dispatch('flashMessage',type:'warning', message: 'Bạn đã gửi lời mời đến người dùng này');
            return;
        }
        $club->clubInviteUsers()->attach($user->id, [
            'status' => StatusRequestClub::Pending->value,
            'message' => $this->content,
            'created_at' => now(),
        ]);

        //gửi thông báo đến người dùng
        $notification = Notification::create([
//            'user_id' => $user->id,
            'club_id' => $club->id,
            'title' => 'Bạn đã nhận được lời mời tham gia câu lạc bộ '.$club->name,
            'type' => 'invite',
            'content' => $this->content,
            'status' => StatusRequestClub::Approved,
//            'is_read' => false,
            'url' => route('client.account',['item'=>5]),
            'created_at' => now(),
        ]);
        //gửi thông báo đến người dùng
        $notification->notificationUsers()->attach($user, [
            'is_read' => false,
        ]);

        $this->content='Chúng tôi rất vui được mời bạn tham gia Câu lạc bộ';
        $this->dispatch('flashMessage',type:'success', message: 'Đã gửi lời mời thành công');
    }

    public function resendInvite(){
        $club = Club::query()->where('id', $this->club_id)->first();
        //xóa lời mời cũ
        $club->clubInviteUsers()->detach($this->user_id);
        $user = User::query()->where('id', $this->user_id)->first();
        $club->clubInviteUsers()->attach($user->id, [
            'status' => StatusRequestClub::Pending->value,
            'message' => $this->content,
            'created_at' => now(),
        ]);
        //gửi thông báo đến người dùng
        $notification = Notification::create([
//            'user_id' => $user->id,
            'club_id' => $club->id,
            'title' => 'Bạn đã nhận được lời mời tham gia câu lạc bộ '.$club->name,
            'type' => 'invite',
            'content' => $this->content,
            'status' => StatusRequestClub::Approved,
//            'is_read' => false,
            'url' => route('client.account',['item'=>5]),
            'created_at' => now(),
        ]);
        $notification->notificationUsers()->attach($user, [
            'is_read' => false,
        ]);
        $this->content='Chúng tôi rất vui được mời bạn tham gia Câu lạc bộ';
        $this->dispatch('flashMessage',type:'success', message: 'Đã gửi lại lời mời thành công');
    }

}
