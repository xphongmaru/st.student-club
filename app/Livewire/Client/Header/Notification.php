<?php

namespace App\Livewire\Client\Header;

use Livewire\Component;
use App\Models\Notification as NotificationModel;

class Notification extends Component
{
    public function render()
    {
        $notifications= null;
        if(auth()->check()){
            $notifications = NotificationModel::query()
                ->where('user_id', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->where('is_read', 0)
                ->take(3)
                ->get();
        }
        return view('livewire.client.header.notification',[
            'notifications' => $notifications,
        ]);
    }

    public function read($id)
    {
        $notification = NotificationModel::query()->where('id', $id)->first();
        if($notification == null){
            $this->dispatch('flashMessage', type:'warning', message: 'Thông báo không tồn tại');
            return;
        }
        $notification->is_read = 1;
        $notification->read_at = now();
        $notification->save();
        return redirect($notification->url);
    }
}
