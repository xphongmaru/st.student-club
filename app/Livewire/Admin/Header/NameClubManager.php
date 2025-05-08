<?php

namespace App\Livewire\Admin\Header;

use Livewire\Component;
use \App\Models\Club;

class NameClubManager extends Component
{
    public $club_id;
    public $club;
    public function render()
    {
        return view('livewire.admin.header.name-club-manager',[
            'club' => $this->club,
        ]);
    }

    public function mount()
    {
        $this->club_id = session()->get('club_id');
        $this->club = Club::query()->where('id', $this->club_id)->first();
    }
}
