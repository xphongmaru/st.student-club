<?php

namespace App\Livewire\Client\Club;

use App\Models\Website;
use Livewire\Component;
use App\Models\Icon;
use Livewire\Attributes\Validate;

class CpnLinkWeb extends Component
{
    public $id;
    public $club;
    #[Validate(as: 'Icon')]
    public $icon_id;
    public $thumbnail;
    #[Validate(as: 'Tên liên kết')]
    public $url;

    public function render()
    {
        $icons = Icon::all();
        return view('livewire.client.club.cpn-link-web',[
            'icons' => $icons,
        ]);
    }

    public function mount()
    {
        $link = Website::query()
            ->where('club_id', $this->club->id)
            ->where('id', $this->id)
            ->first();
        if($link){
            $this->icon_id = $link->icon_id;
            $this->url = $link->url;
            $this->thumbnail = Icon::query()->find($this->icon_id)->thumbnail;
        }
    }

    public function RemoveComponent()
    {
        $this->dispatch('removeCPNLinkWeb', $this->id);
    }

    public function updated($field)
    {
        if($this->icon_id != 0){
            $this->thumbnail = Icon::query()->find($this->icon_id)->thumbnail;
        }else{
            $this->thumbnail = null;
        }
        $this->validate();
        $this->dispatch('updateCPNLinkWeb', [
            'id' => $this->id,
            'icon_id' => $this->icon_id,
            'url' => $this->url,
        ]);
    }

    protected function rules()
    {
        return [
            'icon_id' => 'required|exists:icons,id',
            'url' => 'required|url',
        ];
    }



}
