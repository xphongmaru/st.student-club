<?php

namespace App\Livewire\Admin\Clubs\RecruitmentMembers;

use Illuminate\Pagination\Paginator;
use Livewire\Component;
use App\Models\RecruitmentClub;
use Livewire\WithPagination;

class RecruitmentIndex extends Component
{
    protected $listeners  =[
        'confirmDeleteRecruitment' => 'confirmDeleteRecruitment',
    ];

    public $club_id;
    public $search='';
    public $recruitment_id;
    public function render()
    {
        $recruitments = RecruitmentClub::query()
            ->where('club_id', $this->club_id)
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.admin.clubs.recruitment-members.recruitment-index',[
            'club_id' => $this->club_id,
            'recruitments' => $recruitments,
            'recruitment_id'=> $this->recruitment_id,
        ]);
    }
    public function boot()
    {
        Paginator::useBootstrap();
    }

    public function openDeleteModel($id)
    {
        $this->recruitment_id = $id;
        $this->dispatch('openModel', type: 'warning', title: 'Bạn có chắc chắn muốn xóa đợt tuyển này không?', text: 'Sẽ xóa hết đơn đăng ký trong đợt tuyển này.', confirmEvent: 'confirmDeleteRecruitment');
    }

    public function confirmDeleteRecruitment()
    {
        $recruitment = RecruitmentClub::query()->where('id', $this->recruitment_id)->first();
        $recruitment->requestMemberClubs()->delete();
        $recruitment->delete();

        $this->dispatch('flashMessage', type: 'success', message: 'Xóa đợt tuyển thành công');
    }
}
