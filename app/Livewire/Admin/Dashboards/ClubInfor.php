<?php

namespace App\Livewire\Admin\Dashboards;

use Livewire\Component;
use \App\Models\Club;
class ClubInfor extends Component
{
    protected $listeners = ['confirmLogoutClub'=>'confirmLogoutClub'];

    public $club_id;
    public $club;

    public function render()
    {
        return view('livewire.admin.dashboards.club-infor',[
            'club' => $this->club,
        ]);
    }

    public function mount(){
        $this->club_id = session()->get('club_id');
        $this->club = Club::query()->where('id', $this->club_id)->first();
    }

    public function logoutClub()
    {
        $this->dispatch('openModel', type: 'info', title: 'Bạn có muốn thoát hệ thống quản lý câu lạc bộ này không?', confirmEvent: 'confirmLogoutClub');
    }

    public function confirmLogoutClub(){
        session()->forget('club_id');
        session()->flash('success', 'Thoát hệ thống quản lý câu lạc bộ thành công!');
        return redirect(route('admin.club.list-club'));
    }
}
