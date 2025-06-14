<?php

namespace App\Livewire\Admin\Clubs\Notifications;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $listeners = [
        'deleteNotification' => 'deleteNotification',
    ];

    public $club_id;

    public $search = '';

    public $id;

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $notifications = Notification::query()
            ->where('club_id', $this->club_id)
            ->where('type', 'new_notification_club')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->orWhere('title', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%');
                });
            })
            ->selectRaw('MIN(id) as id, title, content, sender_id, type, url, club_id')
            ->groupBy('club_id', 'title', 'content', 'sender_id', 'type', 'url')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.admin.clubs.notifications.index',[
            'notifications' => $notifications,
            'club_id' => $this->club_id,
        ]);
    }

    public function openDeleteModel($id)
    {
        $this->id = $id;
        $this->dispatch('openModel', type:'warning', title:'Bạn có chắc chắn muốn xóa thông báo này không?', confirmEvent:'deleteNotification');
    }

    public function deleteNotification(){
        $notification = Notification::query()->where('id', $this->id)->first();
        if ($notification) {
            // Xóa tất cả các bản ghi liên quan đến thông báo nàyq
            $notification->notificationUsers()->detach();
            $notification->delete();
            $this->dispatch('flashMessage', type: 'success', message: 'Xóa thông báo thành công.');
        } else {
            $this->dispatch('flashMessage', type: 'error', message: 'Thông báo không tồn tại.');
        }
        $this->id = null; // Reset the id after deletion
    }
}
