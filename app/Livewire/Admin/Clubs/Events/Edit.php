<?php

namespace App\Livewire\Admin\Clubs\Events;

use App\Models\Event;
use App\Models\EventGallery;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    use \Livewire\WithFileUploads;

    public $club_id;
    public $event_id;
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

    public $oldThumbnail;
    public $oldPhotos = [];

    public function render()
    {
        return view('livewire.admin.clubs.events.edit');
    }

    public function mount(){
        $event = Event::query()->find($this->event_id);
        if ($event) {
            $this->name = $event->name;
            $this->description = $event->description;
            $this->oldThumbnail = $event->thumbnail;
            $this->oldPhotos = $event->galleries()->pluck('path')->toArray();
            $this->event_date = $event->event_date;
        } else {
            session()->flash('error', 'Sự kiện không tồn tại.');
            return redirect()->route('admin.club.event-index', ['id' => $this->club_id]);
        }

    }

    public function removeOldPhoto($path)
    {
        if (in_array($path, $this->oldPhotos)) {
            $this->oldPhotos = array_diff($this->oldPhotos, [$path]);
        }
    }

    public function update()
    {
        $this->validate();

        $event = Event::findOrFail($this->event_id);

        // Cập nhật event chính
        $event->update([
            'name' => $this->name,
            'description' => $this->description,
            'event_date' => $this->event_date,
            'thumbnail' => $this->thumbnail ? $this->thumbnail->store('Clubs/Events/Thumbnails', 'public') : $event->thumbnail,
        ]);

        // Xoá ảnh cũ đã bị remove
        $existingPhotos = $event->galleries()->pluck('path')->toArray();
        $removedPhotos = array_diff($existingPhotos, $this->oldPhotos);

        foreach ($removedPhotos as $path) {
            Storage::disk('public')->delete($path);
            EventGallery::where('path', $path)->delete();
        }

        // Thêm ảnh mới
        foreach ($this->photos as $photo) {
            $path = $photo->store('Clubs/Events/Galleries', 'public');
            $event->galleries()->create(['path' => $path]);
        }

        session()->flash('message', 'Sự kiện đã được cập nhật!');
        return redirect()->route('admin.club.event-index', ['id' => $this->club_id]);
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'thumbnail' => 'nullable|image|max:2048',
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
