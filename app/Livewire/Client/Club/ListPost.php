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

            // Gửi thông báo đến tất cả user trong club
            $users = $this->club->users;
            foreach ($users as $user) {
                Notification::create([
                    'user_id'  => $user->id,
                    'title'    => $this->club->name . ' đã có bài viết mới',
                    'content'  => $post->title,
                    'type'     => 'newPost',
                    'club_id'  => $this->club->id,
                    'status'   => 'pending',
                    'url'      => route('client.club.post-detail', [
                        'id'   => $this->club->id,
                        'slug' => $post->slug,
                    ]),
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
