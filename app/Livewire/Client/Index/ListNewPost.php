<?php

namespace App\Livewire\Client\Index;

use Livewire\Component;
use App\Models\Post;

class ListNewPost extends Component
{
    public function render()
    {
        $posts = Post::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        return view('livewire.client.index.list-new-post',[
            'posts' => $posts,
        ]);
    }
}
