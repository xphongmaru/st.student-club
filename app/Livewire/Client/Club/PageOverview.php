<?php

namespace App\Livewire\Client\Club;

use Livewire\Component;
use Carbon\Carbon;

class PageOverview extends Component
{
    public $club;
    public $years;

    public function render()
    {
        return view('livewire.client.club.page-overview',
        [
            'years' => $this->years,
        ]);
    }
    public function mount($club)
    {
        $this->club = $club;
        $this->years = round(Carbon::parse($club->foundation_date)->floatDiffInYears(now()), 1); // vd: 25.3 năm
    }
}
