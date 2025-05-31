<?php

namespace App\Livewire\Admin\Clubs\Events;

use App\Models\Club;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Event;

class Create extends Component
{
    use \Livewire\WithFileUploads;

    public $club_id;
    #[Validate(as: 'tên sự kiện')]
    public $name;

    #[Validate(as: 'mô tả')]
    public $description;

    #[Validate(as: 'ảnh đại diện')]
    public $thumbnail;

    #[Validate(as: 'ảnh sự kiện')]
    public $photos = [];

    #[Validate(as: 'ngày diễn ra sự kiện')]
    public $event_date;

    public function render()
    {
        return view('livewire.admin.clubs.events.create');
    }

    public function store()
    {
        $this->validate();
        $event = new Event();
        $event->club_id = $this->club_id;
        $event->name = $this->name;
        $event->description = $this->description;
        $event->event_date = $this->event_date;
        $event->thumbnail = $this->thumbnail->store('Clubs/Events', 'public');
        $event->save();
        if(!empty($this->photos)) {
            foreach ($this->photos as $photo) {
                $event->galleries()->create([
                    'path' => $photo->store('Clubs/Events', 'public'),
                ]);
            }
        } else {
            $event->photos = [];
        }
        session()->flash('success', 'Sự kiện đã được tạo thành công.');
        $club = Club::query()->findOrFail($this->club_id);
        $club->events_count ++;
        $club->save();
        return redirect()->route('admin.club.event-index', ['id' => $this->club_id]);
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'thumbnail' => 'required|image|max:2048',
            'photos.*' => 'nullable|image|max:2048',
            'event_date' => 'required|date|before_or_equal:today',
        ];
    }

    public function removePhoto($id)
    {
        unset($this->photos[$id]);
        $this->photos = array_values($this->photos);

    }
}
