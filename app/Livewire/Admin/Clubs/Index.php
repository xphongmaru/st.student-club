<?php

namespace App\Livewire\Admin\Clubs;

use Livewire\Component;
use Illuminate\Pagination\Paginator;
use App\Models\Club;
use App\Models\User;
use App\Enums\StatusClub;

class Index extends Component
{
    public $club_id;

    protected $listeners = [
        'confirmCloseClub'=>'confirmCloseClub',
        'confirmOpenClub' => 'confirmOpenClub'
    ];

    public function render()
    {
        $clubs = Club::query()
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('livewire.admin.clubs.index',[
            'clubs' => $clubs,
        ]);
    }

    public function closeStatusClub($id)
    {
        $this->club_id = $id;
        $this->dispatch('openModel',type: 'warning', title: 'Bạn có chắc chắn muốn ngừng hoạt động CLB này không?', confirmEvent: 'confirmCloseClub');
    }
    public function confirmCloseClub(){
        $club = Club::query()->find($this->club_id);
        if ($club) {
            $club->update([
                'status' => StatusClub::Inactive,
            ]);
            $this->dispatch('flashMessage', type: 'success', message: 'Ngừng hoạt động CLB thành công');
        } else {
            $this->dispatch('flashMessage', type: 'error', message: 'Câu lạc bộ không tồn tại');
        }
    }

    public function openStatusClub($id){
        $this->club_id = $id;
        $this->dispatch('openModel', type: 'warning', title: 'Bạn có chắc chắn muốn mở hoạt động CLB này không?', confirmEvent: 'confirmOpenClub');
    }

    public function confirmOpenClub(){
        $club = Club::query()->find($this->club_id);
        if ($club) {
            $club->update([
                'status' => StatusClub::Active,
            ]);
            $this->dispatch('flashMessage', type: 'success', message: 'Mở hoạt động CLB thành công');
        } else {
            $this->dispatch('flashMessage', type: 'error', message: 'Câu lạc bộ không tồn tại');
        }
    }
}
