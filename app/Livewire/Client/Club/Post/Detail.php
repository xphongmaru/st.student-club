<?php

namespace App\Livewire\Client\Club\Post;

use Livewire\Component;
use function Symfony\Component\Translation\t;

class Detail extends Component
{

    public $post;
    public function render()
    {
        return view('livewire..client.club.post.detail');
    }

    public function likePost()
    {
        if(!auth()->check()) {
            $this->dispatch('flashMessage', type: 'warning', message: ('Bạn cần đăng nhập để thực hiện chức năng này'));
            return;
        }

        if($this->post->likePosts()->where('user_id', auth()->id())->exists()) {
            $this->post->likePosts()->detach(auth()->id());
            $this->post->likes_count--;
            if($this->post->likes_count < 0) {
                $this->post->likes_count = 0;
            }
            $this->post->save();
            $this->dispatch('flashMessage', type: 'warning', message: ('Bạn đã bỏ thích bài viết này'));
        } else {
            $this->post->likePosts()->attach(auth()->id());
            $this->post->likes_count++;
            $this->post->save();
            $this->dispatch('flashMessage', type: 'success', message: ('Bạn đã thích bài viết này'));
        }
    }
}
