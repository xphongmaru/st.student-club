<?php

namespace App\Livewire\Admin\Clubs\Posts;

use Livewire\Component;

class Detail extends Component
{
    public $post_id;
    public $club_id;
    public function render()
    {
        $post = \App\Models\Post::find($this->post_id);
        return view('livewire.admin.clubs.posts.detail',[
            'post' => $post,
        ]);
    }
}
