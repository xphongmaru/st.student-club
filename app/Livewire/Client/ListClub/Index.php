<?php

namespace App\Livewire\Client\ListClub;

use App\Models\Club;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search = '';
//    protected $queryString = ['search'];

    public function render()
    {
        $query = Club::query()
            ->where('status', 'active');

        $query->where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhere('phone', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('slogan', 'like', '%' . $this->search . '%')
                ->orWhere('field_of_activity', 'like', '%' . $this->search . '%');
        });

        $clubs = $query
            ->orderBy('created_at', 'desc')
            ->paginate(1);

        return view('livewire.client.list-club.index',[
            'clubs' => $clubs,
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
