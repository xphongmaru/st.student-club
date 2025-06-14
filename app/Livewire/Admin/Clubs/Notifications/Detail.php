<?php

namespace App\Livewire\Admin\Clubs\Notifications;

use App\Models\Club;
use App\Models\Notification;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Detail extends Component
{
    public $club_id;
    public $notification_id;


    public function render()
    {
        $notification = Notification::with('notificationUsers')
            ->findOrFail($this->notification_id);
        $club = Club::query()->where('id', $this->club_id)->first();
        $roles = $club->roleClubs;
        $attachments = $notification->attachments;
        return view('livewire.admin.clubs.notifications.detail',[
                'notification' => $notification,
                'club' => $club,
                'roles' => $roles,
                'attachments' => $attachments,
        ]);
    }


}
