<?php

namespace App\Livewire\Client\Club\Post;

use Livewire\Component;


class CommentList extends Component
{

    protected $listeners = [
        'refreshCommentList' => '$refresh',
        'refreshComment' => 'refreshComment',
        ];
    public $post;

    public $perPage = 5;

    public function loadMore()
    {
        $this->perPage += 5;
    }

    public function render()
    {
        $comments = $this->post->comments()
            ->where('parent_id','=', null)
            ->orderBy('created_at', 'desc')
            ->take($this->perPage)
            ->get();
        return view('livewire.client.club.post.comment-list',[
            'comments' => $comments,
            'post' => $this->post,
        ]);
    }

    public function refreshComment()
    {
        $this->render();
    }
}
