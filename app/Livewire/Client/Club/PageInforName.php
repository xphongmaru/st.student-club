<?php

namespace App\Livewire\Client\Club;

use Livewire\Component;
use App\Models\Club;


class PageInforName extends Component
{
    use \Livewire\WithFileUploads;

    public $clubId;
    public $club;

    public $banner;
    public $thumbnail;

    public function render()
    {
        return view('livewire.client.club.page-infor-name',[
            'club' => $this->club,
        ]);
    }

    public function mount($club_id)
    {
        $this->clubId = $club_id;
        $this->club = Club::query()
            ->where('id', $this->clubId)
            ->first();
    }

    public function removeBanner()
    {
        $this->banner = null;
    }

    public function removeThumbnail()
    {
        $this->thumbnail = null;
    }

    public function updateBanner()
    {
        $this->validate([
            'banner' => 'image|max:2048', // 2MB Max
        ]);

        if ($this->banner) {
            //xóa ảnh cũ
            if ($this->club->banner) {
                $oldImagePath = public_path('storage/' . $this->club->banner);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $bannerPath = $this->banner->store('Clubs/Banner', 'public');
            $this->club->banner = $bannerPath;
        }
        $this->club->save();
        $this->banner = null;
        $this->dispatch('flashMessage', type: 'success', message: 'Cập nhật banner câu lạc bộ thành công');
    }

    public function updateThumbnail()
    {
        $this->validate([
            'thumbnail' => 'image|max:2048', // 2MB Max
        ]);

        if ($this->thumbnail) {
            //xóa ảnh cũ
            if ($this->club->thumbnail) {
                $oldImagePath = public_path('storage/' . $this->club->thumbnail);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $thumbnailPath = $this->thumbnail->store('Clubs/Logo', 'public');
            $this->club->thumbnail = $thumbnailPath;
        }
        $this->club->save();
        $this->thumbnail = null;
        $this->dispatch('flashMessage', type: 'success', message: 'Cập nhật logo câu lạc bộ thành công');

    }

}
