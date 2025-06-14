<?php

namespace App\Livewire\Client\Account;

use Livewire\Component;
use App\Models\Notification as NotificationModel;
use Livewire\WithPagination;
use Nette\Utils\Paginator;

class Notification extends Component
{
    public $take = 5;
    public function render()
    {
        $notifications = auth()->user()->notificationUsers()
            ->orderBy('created_at', 'desc')
            ->take($this->take)
            ->get();
        $hasNotification = auth()->user()->notificationUsers()
            ->wherePivot('is_read', 0)
            ->count();
        return view('livewire.client.account.notification',[
            'notifications'=>$notifications,
            'hasNotification' => $hasNotification,
        ]);
    }

    public function loadMore()
    {
        $this->take += 3;
    }

    public function ReadAllNoti()
    {
        $notifications = auth()->user()
            ->notificationUsers()
            ->wherePivot('is_read', 0)
            ->get();

        foreach ($notifications as $notification) {
            auth()->user()->notificationUsers()->updateExistingPivot($notification->id, ['is_read' => 1]);
        }

        $this->dispatch('flashMessage', type:'success', message: 'Đã đánh dấu tất cả thông báo là đã đọc');

    }

    public function read($id)
    {
        $notification = NotificationModel::query()->where('id', $id)->first();
        if($notification == null){
            $this->dispatch('flashMessage', type:'warning', message: 'Thông báo không tồn tại');
            return;
        }
        $notification->notificationUsers()->updateExistingPivot(auth()->user()->id, [
            'is_read' => true,
            'read_at' => now(),
        ]);
        $notification->save();
        return redirect($notification->url);
    }

    public function deleteNoti($id)
    {
        $noti = NotificationModel::query()->where('id', $id)->first();
        if($noti == null){
            $this->dispatch('flashMessage', type:'warning', message: 'Thông báo không tồn tại');
            return;
        }
        $noti->notificationUsers()->detach(auth()->user()->id);
        $this->dispatch('flashMessage', type:'success', message: 'Đã xóa thông báo');
    }

    public function readNoti($id)
    {
        $notification = NotificationModel::query()->where('id', $id)->first();
        if($notification == null){
            $this->dispatch('flashMessage', type:'warning', message: 'Thông báo không tồn tại');
            return;
        }
        $notification->notificationUsers()->updateExistingPivot(auth()->user()->id, [
            'is_read' => true,
            'read_at' => now(),
        ]);
        $notification->save();
    }
}
