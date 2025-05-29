<?php

namespace App\Livewire\Client\Post;

use App\Models\Club;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search = '';
    public $selectedClubs=[];
    public function render()
    {
        $query = Post::query()
            ->where('status', 'published');

        $query->where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('sort_content', 'like', '%' . $this->search . '%')
                ->orWhere('content', 'like', '%' . $this->search . '%')
                ->orWhere('publicDate', 'like', '%' . $this->search . '%')
                ->orWhereHas('user', function ($query) {;
                    $query->where('full_name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('categoryPost', function ($query) {;
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('club', function ($query) {;
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
        });
        if(!empty($this->selectedClubs)) {
            $query->whereIn('club_id', $this->selectedClubs);
        }

        $posts = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $postFamous = Post::query()
            ->where('status', 'published')
            ->orderBy('likes_count', 'desc')
            ->take(4)
            ->get();

        $clubs=Club::query()->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('livewire.client.post.index',[
            'postFamous' => $postFamous,
            'posts' => $posts,
            'clubs' => $clubs,
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
