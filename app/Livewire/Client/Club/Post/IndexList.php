<?php

namespace App\Livewire\Client\Club\Post;

use App\Enums\StatusPost;
use App\Models\CategoryPost;
use App\Models\Notification;
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
        $posts = Post::where('club_id', $this->club->id)
            ->where('status', StatusPost::scheduled->name)
            ->where('publicDate', '<=', now())
            ->get();
        foreach ($posts as $post) {
            // Cập nhật trạng thái bài viết
            $post->update(['status' => StatusPost::published->name]);

            //tạo thông báo đến thành viên câu lạc bô
            $notification = Notification::query()->create([
                'title' => $this->club->name . ' đã có bài viết mới',
                'content' => $post->title,
                'type' => 'newPost',
                'club_id' => $post->club_id,
                'url' => route('client.club.post-detail', ['id' => $this->club->id, 'slug' => str($post->title)->slug()]),
            ]);
            $users = $this->club->users;
            $followers = $this->club->followers;

            // Hợp nhất danh sách thành viên và người theo dõi, sau đó loại bỏ trùng lặp
            $uniqueUsers = $users->merge($followers)->unique('id');
            // Tạo thông báo cho từng người dùng duy nhất

            foreach ($uniqueUsers as $user) {
                $notification->notificationUsers()->attach($user->id, [
                    'is_read' => false,
                ]);
            }
        }

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
