<?php

namespace App\Livewire\Client\Club\Post;

use App\Models\CategoryPost;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class IndexList extends Component
{
    use WithPagination;
    public $club;

    public $search = '';
    public $selectedCategories=[];

    public function render()
    {
        $query = Post::query()
            ->where('club_id', $this->club->id)
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
        if(!empty($this->selectedCategories)) {
            $query->whereIn('category_post_id', $this->selectedCategories);
        }

        $posts = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $postFamous = Post::query()
            ->where('club_id', $this->club->id)
            ->where('status', 'published')
            ->orderBy('likes_count', 'desc')
            ->take(4)
            ->get();

        $categories = CategoryPost::query()
            ->where('club_id', $this->club->id)
            ->get();

        return view('livewire.client.club.post.index-list',[
            'posts' => $posts,
            'postFamous' => $postFamous,
            'categories' => $categories,
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedCategories()
    {
        $this->resetPage();
    }
}
