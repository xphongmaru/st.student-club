<?php

namespace App\Livewire\Admin\Clubs\RecruitmentMembers;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\RecruitmentClub;

class RecruitmentDetail extends Component
{

    public $club_id;
    public $recruitment_id;

    #[Validate(as:'Tên đợt tuyển thành viên')]
    public $name;
    #[Validate(as:'Ngày bắt đầu')]
    public $start_date;

    #[Validate(as:'Ngày kết thúc')]
    public $end_date;


    public function render()
    {
        return view('livewire.admin.clubs.recruitment-members.recruitment-detail');
    }

    public function mount()
    {
        $recruitment = RecruitmentClub::query()
            ->where('id', $this->recruitment_id)
            ->first();
        $this->name = $recruitment->name;
        $this->start_date = $recruitment->start_date->format('Y-m-d H:i');
        $this->end_date = $recruitment->end_date->format('Y-m-d H:i');
    }

    public function update(){
        $this->validate();
        $hasRecruitment2 = RecruitmentClub::where('club_id', $this->club_id)
            ->where('start_date', '<=', $this->start_date)
            ->where('end_date', '>=', $this->end_date)
            ->where('id', '!=', $this->recruitment_id)
            ->exists();

        if($hasRecruitment2){
            $this->dispatch('flashMessage', type: 'warning', message: 'Đang có một đợt tuyển trong thời gian này.');
            return;
        }

        $hasRecruitment3 = RecruitmentClub::where('club_id', $this->club_id)
            ->where('end_date', '>=', $this->start_date)
            ->where('end_date', '<=', $this->end_date)
            ->where('id', '!=', $this->recruitment_id)
            ->exists();

        if($hasRecruitment3){
            $this->dispatch('flashMessage', type: 'warning', message: 'Đang có một đợt tuyển trong thời gian này.');
            return;
        }

        $hasRecruitment4 = RecruitmentClub::where('club_id', $this->club_id)
            ->where('start_date', '>=', $this->start_date)
            ->where('end_date', '<=', $this->end_date)
            ->where('id', '!=', $this->recruitment_id)
            ->exists();
        if($hasRecruitment4){
            $this->dispatch('flashMessage', type: 'warning', message: 'Đang có một đợt tuyển trong thời gian này.');
            return;
        }

        $recruitment = RecruitmentClub::query()
            ->where('id', $this->recruitment_id)
            ->first();
        $recruitment->name = $this->name;
        $recruitment->start_date = $this->start_date;
        $recruitment->end_date = $this->end_date;
        $recruitment->save();
        session()->flash('success','Cập nhật đợt tuyển thành công.');
        return redirect()->route('admin.club.recruitment-member-index',['id'=> $this->club_id]);
    }


    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:recruitment_clubs,name,' . $this->recruitment_id,
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ];
    }
}
