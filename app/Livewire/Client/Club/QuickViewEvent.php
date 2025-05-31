<?php

namespace App\Livewire\Client\Club;

use App\Models\Event;
use Livewire\Component;

class QuickViewEvent extends Component
{
    protected $listeners = ['quickViewEvent' => 'quickViewEvent'];

    public $eventId;
    public $event;
    public $photos;
    public $club;

    public function render()
    {
        return view('livewire.client.club.quick-view-event');
    }

    public function quickViewEvent($eventId)
    {
        $this->eventId = $eventId;
        $this->event = Event::query()->where('id', $this->eventId)->first();
        $this->photos = $this->event->galleries()->get();

        $this->dispatch('loadPhoto'); // Chỉ gọi khi dữ liệu thay đổi
    }
}

