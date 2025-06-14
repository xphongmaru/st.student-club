<?php

namespace App\Livewire\Client\Index;

use App\Enums\StatusPost;
use App\Models\Notification;
use App\Models\Post;
use Livewire\Component;
use App\Models\Club;
use App\Enums\StatusClub;

class ClubList extends Component
{
    public $clubs;

    public function render()
    {
        $this->clubs = Club::query()
            ->where('status', StatusClub::Active->value)
            ->orderByDesc('likes_count')
            ->orderByDesc('followers_count')
            ->get();

        $clubPosts = Club::query()->where('status', StatusClub::Active->value)->get();
        foreach ($clubPosts as $club) {
            $posts = Post::where('club_id', $club->id)
                ->where('status', StatusPost::scheduled->name)
                ->where('publicDate', '<=', now())
                ->get();
            foreach ($posts as $post) {
                // Cập nhật trạng thái bài viết
                $post->update(['status' => StatusPost::published->name]);

                //tạo thông báo đến thành viên câu lạc bô
                $notification = Notification::query()->create([
                    'title' => $club->name . ' đã có bài viết mới',
                    'content' => $post->title,
                    'type' => 'newPost',
                    'club_id' => $post->club_id,
                    'url' => route('client.club.post-detail', ['id' => $club->id, 'slug' => str($post->title)->slug()]),
                ]);
                $users = $club->users;
                $followers = $club->followers;

                // Hợp nhất danh sách thành viên và người theo dõi, sau đó loại bỏ trùng lặp
                $uniqueUsers = $users->merge($followers)->unique('id');
                // Tạo thông báo cho từng người dùng duy nhất

                foreach ($uniqueUsers as $user) {
                    $notification->notificationUsers()->attach($user->id, [
                        'is_read' => false,
                    ]);
                }
            }
        }
        return view('livewire.client.index.club-list',
        [
                'clubs' => $this->clubs,
        ]);
    }
}
