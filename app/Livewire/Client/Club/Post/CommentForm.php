<?php

namespace App\Livewire\Client\Club\Post;

use Livewire\Component;
use App\Models\Comment;
use Livewire\Attributes\Validate;

class CommentForm extends Component
{
    public $post;
    public $parentId;

    #[Validate(as: 'nội dung bình luận')]
    public $content;

    public function render()
    {
        return view('livewire.client.club.post.comment-form');
    }

    public function submit(){
        if(!auth()->check()) {
            $this->dispatch('flashMessage', type: 'warning', message: 'Bạn cần đăng nhập để thực hiện chức năng này');
            return;
        }

        $this->validate();

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $this->post->id,
            'parent_id' => $this->parentId,
            'content' => $this->content,
        ]);

        $this->dispatch('flashMessage', type: 'success', message: 'Bình luận thành công');
        $this->dispatch('refreshCommentList');
        $this->reset('content');

    }

    protected function rules()
    {
        return [
            'content' => 'required|max:500',
        ];
    }
}
