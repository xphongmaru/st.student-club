<?php

namespace App\Livewire\Admin\Clubs;

use Livewire\Component;
use App\Models\Club;
use App\Enums\StatusClub;

class ClubDetail extends Component
{
    protected $listeners = [
        'presidentChanged' => 'refresh',
        'confirmCloseClub' => 'confirmCloseClub',
        'confirmOpenClub' => 'confirmOpenClub',

    ];
    public $club_id;
    public $club;
    public $oldStatus;
    public $status;

    public function render()
    {
        return view('livewire.admin.clubs.club-detail',[
            'club' => $this->club,
        ]);
    }

    public function mount($id)
    {
        $this->club_id = $id;
        $this->club = Club::query()->find($this->club_id);
        $this->oldStatus = $this->club->status;
        $this->status = $this->club->status;
    }

    public function refresh()
    {
        $this->club = Club::query()->find($this->club_id);
    }

    public function update(){
        if($this->oldStatus != $this->status && $this->status == StatusClub::Inactive->value){
            $this->dispatch('openModel', type: 'warning', title: 'Bạn có chắc chắn muốn ngừng hoạt động CLB này không?', confirmEvent: 'confirmCloseClub');
        }
        else if($this->oldStatus != $this->status && $this->status == StatusClub::Active->value){
            $this->dispatch('openModel', type: 'warning', title: 'Bạn có chắc chắn muốn mở hoạt động CLB này không?', confirmEvent: 'confirmOpenClub');
        }
        else {
            $this->dispatch('flashMessage', type: 'warning', message: 'Bạn chưa thay đổi trạng thái câu lạc bộ');
        }
    }

    public function confirmCloseClub(){
        $this->club->update([
            'status' => StatusClub::Inactive,
        ]);
        session()->flash( 'success','Ngừng hoạt động CLB thành công');
        return redirect()->route('admin.club.index');
    }

    public function confirmOpenClub(){
        $this->club->update([
            'status' => StatusClub::Active,
        ]);
        session()->flash( 'success','Mở hoạt động CLB thành công');
        return redirect()->route('admin.club.index');
    }
}
