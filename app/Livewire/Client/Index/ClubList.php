<?php

namespace App\Livewire\Client\Index;

use Livewire\Component;
use App\Models\Club;
use App\Enums\StatusClub;

class ClubList extends Component
{
    public $clubs;

    public function render()
    {
        $this->clubs = Club::query()
            ->where('status', StatusClub::Active->value)
            ->orderByDesc('likes_count')
            ->orderByDesc('followers_count')
            ->get();
        return view('livewire.client.index.club-list',
        [
                'clubs' => $this->clubs,
        ]);
    }
}
