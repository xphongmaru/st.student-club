<?php

namespace App\Livewire\Admin\Clubs;

use Livewire\Component;
use App\Models\Club;

class ListClub extends Component
{
    protected $listeners = ['confirmManageClub' => 'confirmManageClub'];
    public $Clubs_id = [];
    public $club_id;
    public function render()
    {
        return view('livewire.admin.clubs.list-club',[
            'clubs' => Club::query()->whereIn('id', $this->Clubs_id)->get(),
        ]);
    }

    public function mount()
    {
        $user = auth()->user();

        $roles = $user->roleClubs()->where('user_id', $user->id)->get();

        foreach ($roles as $role) {
            $permission= $role->rolePermissionClubs()->where('name', 'truy cập trang quản lý')->exists();
            if($permission){
                $club = Club::query()->where('id', $role->club_id)->first();
                if($club){
                    $this->Clubs_id[] = $role->club_id;
                }
            }
        }

    }

    public function manageClub($club_id)
    {
        $this->club_id = $club_id;
        $this->dispatch('openModel', type: 'info', title: ' Bạn có muốn truy cập quản lý câu lạc bộ này không.', confirmEvent: 'confirmManageClub');
    }

    public function confirmManageClub(){
        if(session('club_id') == $this->club_id){
            $this->dispatch('flashMessage', type: 'warning', message: 'Bạn đang quản lý câu lạc bộ này rồi!');
        }
        else{
            session()->put('club_id', $this->club_id);
            session()->flash( 'success','Chuyển đổi quản lý câu lạc bộ thành công!');
            return redirect(route('admin.dashboard'));
        }
        return 1;
    }
}
