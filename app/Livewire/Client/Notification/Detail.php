<?php

namespace App\Livewire\Client\Notification;

use Livewire\Component;

class Detail extends Component
{
    public $notification;
    public function render()
    {
        $attachments = $this->notification->attachments;
        return view('livewire.client.notification.detail',[
            'attachments' => $attachments,
        ]);
    }
}
