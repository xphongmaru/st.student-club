<?php

namespace App\Livewire\Admin\Clubs\Events;

use App\Models\Event;
use Livewire\Component;

class Detail extends Component
{
    public $event_id;
    public $club_id;

    public function render()
    {
        $event = Event::query()->where('id', $this->event_id)->first();
        $photos = $event->galleries()->get();
        return view('livewire.admin.clubs.events.detail',[
            'event' => $event,
            'photos' => $photos,
        ]);
    }
}
