<?php

namespace App\Livewire\Client\Club;

use Livewire\Component;

class PageDescription extends Component
{
    protected $listeners = ['refreshPage'=>'refreshPage'];

    public $club;

    public function render()
    {
        return view('livewire.client.club.page-description');
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
