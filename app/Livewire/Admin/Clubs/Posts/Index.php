<?php

namespace App\Livewire\Admin\Clubs\Posts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Enums\StatusPost;
use App\Models\Post;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $club_id;
    public $search;
    public $selectedStatus;

    public function render()
    {
        $status= StatusPost::cases();
        if(Auth::user()->hasPermissonClub('Quản lý bài viết', $this->club_id) == true) {
            $posts = Post::query()
                ->where('club_id', $this->club_id)
                ->when($this->search, function ($query) {
                    $query->where(function ($query) {
                        $query->where('title', 'like', '%' . $this->search . '%')
                            ->orWhere('content', 'like', '%' . $this->search . '%')
                            ->orWhereHas('user', function ($query) {
                                $query->where('full_name', 'like', '%' . $this->search . '%');
                            })
                            ->orWhereHas('categoryPost', function ($query) {
                                $query->where('name', 'like', '%' . $this->search . '%');
                            });
                    });
                })
                ->when($this->selectedStatus, function ($query) {
                    $query->where('status', $this->selectedStatus);
                })
                ->where(function ($query) {
                    $query->where('status', '!=', StatusPost::draft->name)
                        ->orWhere(function ($q) {
                            $q->where('status', StatusPost::draft->name)
                                ->where('user_id', auth()->id());
                        });
                })
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }
        else{
            $posts = Post::query()
                ->where('club_id', $this->club_id)
                ->where('user_id', Auth::user()->id)
                ->when($this->search, function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%')
                        ->orWhereHas('categoryPost', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        });
                })
                ->when($this->selectedStatus, function ($query) {
                    $query->where('status', $this->selectedStatus);
                })
                ->where('user_id',Auth::id())
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }

        return view('livewire.admin.clubs.posts.index',[
            'status' => $status,
            'posts' => $posts,
        ]);
    }
    protected $paginationTheme = 'bootstrap';
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedStatus()
    {
        $this->resetPage(); // khi lọc trạng thái thay đổi
    }
}
