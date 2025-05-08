<?php

namespace App\Livewire\Admin\Clubs\RecruitmentMembers;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\RecruitmentClub;

class RecruitmentCreate extends Component
{
    public $club_id;

    #[Validate(as:'Tên đợt tuyển thành viên')]
    public $name;
    #[Validate(as:'Ngày bắt đầu')]
    public $start_date;

    #[Validate(as:'Ngày kết thúc')]
    public $end_date;

    public function render()
    {
        return view('livewire.admin.clubs.recruitment-members.recruitment-create',[
            'club_id'=> $this->club_id,
        ]);
    }

    public function store()
    {
        $this->validate();

        $hasRecruitment1 = RecruitmentClub::where('club_id', $this->club_id)
            ->where('start_date', '>=', $this->start_date)
            ->where('end_date', '>=', $this->end_date)
            ->exists();
        if($hasRecruitment1){
            $this->dispatch('flashMessage', type: 'warning', message: 'Đang có một đợt tuyển trong thời gian này.');
            return;
        }

        $hasRecruitment2 = RecruitmentClub::where('club_id', $this->club_id)
            ->where('start_date', '<=', $this->start_date)
            ->where('end_date', '>=', $this->end_date)
            ->exists();

        if($hasRecruitment2){
            $this->dispatch('flashMessage', type: 'warning', message: 'Đang có một đợt tuyển trong thời gian này.');
            return;
        }

        $hasRecruitment3 = RecruitmentClub::where('club_id', $this->club_id)
            ->where('end_date', '>=', $this->start_date)
            ->where('end_date', '<=', $this->end_date)
            ->exists();

        if($hasRecruitment3){
            $this->dispatch('flashMessage', type: 'warning', message: 'Đang có một đợt tuyển trong thời gian này.');
            return;
        }

        $hasRecruitment4 = RecruitmentClub::where('club_id', $this->club_id)
            ->where('start_date', '>=', $this->start_date)
            ->where('end_date', '<=', $this->end_date)
            ->exists();
        if($hasRecruitment4){
            $this->dispatch('flashMessage', type: 'warning', message: 'Đang có một đợt tuyển trong thời gian này.');
            return;
        }

        RecruitmentClub::create([
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'club_id' => $this->club_id,
        ]);
        session()->flash('success','Thêm đợt tuyển mới thành công.');
        return redirect()->route('admin.club.recruitment-member-index',['id'=> $this->club_id]);
    }

    protected function rules(){
        return [
            'name' => 'required|string|max:500|unique:recruitment_clubs,name',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ];
    }
}
