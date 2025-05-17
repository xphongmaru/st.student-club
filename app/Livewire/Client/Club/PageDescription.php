<?php

namespace App\Livewire\Client\Club;

use App\Models\Club;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Website;

class PageDescription extends Component
{
    protected $listeners = ['refreshPage'=>'refreshPage'];

    public $club;

    public function render()
    {
        $websites = Website::query()->where('club_id',$this->club->id)->get();
        $recruitmentClubs = Club::whereHas('recruitmentClubs', function ($query) {
            $query->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now());
             })
            ->where('id', $this->club->id)
            ->exists();

        return view('livewire.client.club.page-description',[
            'recruitmentClubs' => $recruitmentClubs,
            'websites' => $websites,
        ]);
    }

    public function mount($club)
    {
        $this->club = $club;
    }

    public function refreshPage()
    {
        $this->club = $this->club->fresh();
    }
}
