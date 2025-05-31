<?php

namespace App\Livewire\Admin\Clubs\Events;

use App\Models\Club;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Event;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $club_id;
    public $search = '';
    public $event_id;

    protected $listeners = [
        'deleteEvent' => 'deleteEvent',
    ];


    public function render()
    {
        $events = Event::with('club')
            ->where('club_id', $this->club_id)
            ->where(function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('event_date', 'desc')
            ->paginate(10);
        return view('livewire.admin.clubs.events.index',[
            'events' => $events,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openDeleteModel($id)
    {
        $this->event_id = $id;
        $this->dispatch('openModel', title:'Bạn có chắc muốn xóa sự kiện này?', type:'warning', confirmEvent: 'deleteEvent');
    }

    public function deleteEvent(){
        $event = Event::find($this->event_id);
        if ($event) {
            // Xóa tất cả ảnh liên quan đến sự kiện
            $photos = $event->galleries()->get();
            foreach ($photos as $gallery) {
                // Xóa file từ thư mục storage/app/public/
                if (Storage::disk('public')->exists($gallery->path)) {
                    Storage::disk('public')->delete($gallery->path);
                }

                // Xóa bản ghi ảnh trong CSDL
                $gallery->delete();
            }
            if (Storage::disk('public')->exists($event->thumbnail)) {
                Storage::disk('public')->delete($event->thumbnail);
            }
            // Xóa sự kiện
            $event->delete();
            $this->dispatch('closeModel');
            $this->dispatch('flashMessage', message: 'Sự kiện đã được xóa thành công!',type: 'success');
            $club = Club::query()->findOrFail($this->club_id);
            $club->events_count --;
            $club->save();
        } else {
            $this->dispatch('flashMessage', message:'Không tìm thấy sự kiện để xóa!',type: 'error');
        }
        $this->reset('event_id');
    }
}
