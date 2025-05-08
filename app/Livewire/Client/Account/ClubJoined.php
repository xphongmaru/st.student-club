<?php

namespace App\Livewire\Client\Account;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Club;

class ClubJoined extends Component
{
    protected $listeners = [
        'confirmLeftClubs'=>'confirmLeftClubs',
        'refreshComponent'=> 'refreshComponent',
    ];

    public $club_id;

    public function render()
    {
        $clubs = auth()->user()->clubs()
            ->orderBy('created_at', 'desc')
            ->get();
        return view('livewire.client.account.club-joined',[
            'clubs' => $clubs,
        ]);
    }

    function LeftClubs($id)
    {
        $this->club_id = $id;
        $this->dispatch('openModel', type:'warning', title: 'Bạn có chắc chắn muốn rời khỏi câu lạc bộ này không?', confirmEvent:'confirmLeftClubs');
    }

    public function confirmLeftClubs(){
        $club = Club::find($this->club_id);
        $user = Auth::user();
        if($club == null){
            $this->dispatch('flashMessage', type:'warning', message: 'Câu lạc bộ không tồn tại');
            return;
        }

        if($club->owner_id == $user->id){
            $this->dispatch('flashMessage', type:'warning', message: 'Bạn không thể rời khỏi câu lạc bộ này vì bạn là chủ tịch');
            return;
        }

        //chuyển dữ liệu sang chủ tịch
        $posts = Post::query()->where('user_id', $user->id)->get();
        foreach ($posts as $post) {
            $post->user_id = $club->owner_id;
            $post->save();
        }

        //xóa thành viên
        $club->users()->detach($user->id);
        $roleClub = $user->getRoleClub($club->id, $user->id);
        if($roleClub != null){
            $user->roleClubs()->detach($roleClub->id);
        }

        $this->dispatch('flashMessage', type:'success', message: 'Rời khỏi câu lạc bộ thành công');
        $this->dispatch('refreshComponent');
    }

    public function refreshComponent()
    {
        $this->render();
    }
}
