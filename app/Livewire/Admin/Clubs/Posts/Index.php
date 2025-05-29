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

    protected $listeners = [
        'deletePost' => 'deletePost',
    ];

    public $club_id;
    public $search;
    public $selectedStatus;
    public $post_id;

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

    public function openDeleteModel($id)
    {
        $this->post_id = $id;
        $this->dispatch('openModel', type: 'warning', title: 'Xóa bài viết', text: 'Bạn có chắc chắn muốn xóa bài viết này không?', confirmEvent: 'deletePost');
    }

    public function deletePost()
    {
        $post = Post::query()->find($this->post_id);
        if($post == null){
            $this->dispatch('flashMessage', type: 'error', message: 'Bài viết không tồn tại');
            return;
        }

        if($post->user_id != auth()->user()->id && Auth::user()->hasPermissonClub('Quản lý bài viết', $this->club_id) == false){
            $this->dispatch('flashMessage', type: 'error', message: 'Bạn không có quyền xóa bài viết này');
            return;
        }
        $post->delete();
        $this->dispatch('flashMessage', type: 'success', message: 'Xóa bài viết thành công');

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
