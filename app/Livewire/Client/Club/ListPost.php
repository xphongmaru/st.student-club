<?php

namespace App\Livewire\Client\Club;

use App\Models\Notification;
use Livewire\Component;
use App\Models\Post;
use App\Enums\StatusPost;

class ListPost extends Component
{
    public $club;

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


        $posts = Post::query()
            ->where('club_id', $this->club->id)
            ->where('status',StatusPost::published->name)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        return view('livewire.client.club.list-post',[
            'posts'=>$posts
        ]);
    }
}
