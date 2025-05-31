<?php

namespace App\Livewire\Client\Club;

use App\Models\Event;
use Livewire\Component;

class ListEvent extends Component
{
    public $club;
    public function render()
    {
        $events = Event::query()
            ->where('club_id', $this->club->id)
            ->orderBy('event_date', 'desc')
            ->get();
        return view('livewire.client.club.list-event',[
            'events' => $events
        ]);
    }

    public function quickViewEvent($id)
    {
        $this->dispatch('quickViewEvent', ['eventId' => $id]);
    }
}
