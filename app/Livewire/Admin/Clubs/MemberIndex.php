<?php

namespace App\Livewire\Admin\Clubs;

use App\Models\Club;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class MemberIndex extends Component
{
    use WithPagination;
    protected $listeners = [
        'deleteMember' => 'deleteMember',
    ];

    public $club_id;
    public $search = '';
    public $delete_id;

    public function render()
    {
        $club = Club::find($this->club_id);
        $members = $club->users()
            ->where(function ($query) {
                $query->where('full_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('livewire.admin.clubs.member-index',[
            'members' => $members,
            'club_id' => $this->club_id,
        ]);
    }

    public function mount(){

    }
    public function boot()
    {
        Paginator::useBootstrap();
    }

    public function openDeleteModel($id)
    {
        $this->delete_id = $id;
        $this->dispatch('openModel', type:'warning', title: 'Bạn có chắc chắn muốn xóa thành viên này không?', text:'Tất cả dữ liệu liên quan sẽ chuyển sang chủ tịch.', confirmEvent:'deleteMember');
    }

    public function deleteMember()
    {
        if(Auth::user()->id == $this->delete_id){
            $this->dispatch('flashMessage', type:'warning', message: 'Bạn không thể xóa chính mình');
            return;
        }
        $club = Club::find($this->club_id);
        if($this->delete_id == null){
            $this->dispatch('flashMessage', type:'warning', message: 'Người dùng không tồn tại');
            return;
        }

        if($this->delete_id == $club->owner_id){
            $this->dispatch('flashMessage', type:'warning', message: 'Bạn không thể xóa chủ tịch câu lạc bộ');
            return;
        }

        //chuyển dữ liệu sang chủ tịch
        $posts = Post::query()->where('user_id', $this->delete_id)->get();
        foreach ($posts as $post) {
            $post->user_id = $club->owner_id;
            $post->save();
        }

        //xóa thành viên
        $club->users()->detach($this->delete_id);
        $club->members_count --;
        $club->save();
        $user = User::query()->find($this->delete_id);
        $roleClub = $user->getRoleClub($club->id, $this->delete_id);
        if($roleClub != null){
            $user->roleClubs()->detach($roleClub->id);
        }

        $this->dispatch('flashMessage', type:'success', message: 'Xóa thành viên thành công');
    }

}
