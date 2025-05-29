<?php

namespace App\Livewire\Client\Club\Post;
use Illuminate\Support\Facades\DB;

use App\Models\Comment;
use Livewire\Component;

class CommentItem extends Component
{
    protected $listeners = [
        'refreshCommentList' => 'refreshCommentList',
        ];
    public $comment;
    public $post;


    public $togleReply = false;
    public function render()
    {
        return view('livewire.client.club.post.comment-item');
    }

    public function replies(){
        if(!auth()->check()) {
            $this->dispatch('flashMessage', type: 'warning', message: 'Bạn cần đăng nhập để thực hiện chức năng này');
            return;
        }
        $this->togleReply = !$this->togleReply;
    }

    public function refreshCommentList()
    {
        $this->render();
        $this->togleReply = false;
    }

    public $repliesToShow = 2;

    public function loadMoreReplies()
    {
        $this->repliesToShow += 3;
    }

    public function getRepliesProperty()
    {
        return $this->comment->replies()->take($this->repliesToShow)->get();
    }

    public function handleLike($id)
    {
        if (!auth()->check()) {
            $this->dispatch('flashMessage', type: 'warning', message: 'Bạn cần đăng nhập để thực hiện chức năng này');
            return;
        }

        $comment = $this->comment->find($id);
        if (!$comment) {
            $this->dispatch('flashMessage', type: 'error', message: 'Bình luận không tồn tại');
            return;
        }

        $userId = auth()->id();
        $liked = $comment->likeComments()->where('user_id', $userId)->exists();

        if ($liked) {
            $comment->likeComments()->detach($userId);
            $comment->decrement('likes_count');
            $this->dispatch('flashMessage', type: 'warning', message: 'Bạn đã bỏ thích bình luận này');
        } else {
            $comment->likeComments()->attach($userId);
            $comment->increment('likes_count');
            $this->dispatch('flashMessage', type: 'success', message: 'Bạn đã thích bình luận này');
        }
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comment = Comment::with('user', 'likeComments')->find($this->comment->id);
    }

    public function mount()
    {
        $this->loadComments();
    }

    public function deleteComment($id)
    {
        if (!auth()->check()) {
            $this->dispatch('flashMessage', type: 'warning', message: 'Bạn cần đăng nhập để thực hiện chức năng này');
            return;
        }

        $comment = Comment::find($id);
        if (!$comment) {
            $this->dispatch('flashMessage', type: 'error', message: 'Bình luận không tồn tại');
            return;
        }

        if ($comment->user_id !== auth()->id()) {
            $this->dispatch('flashMessage', type: 'error', message: 'Bạn không có quyền xóa bình luận này');
            return;
        }

        DB::transaction(function () use ($comment) {
            $this->deleteRepliesRecursively($comment);

            // Cuối cùng xóa bình luận gốc
            $comment->likeComments()->detach();
            $comment->delete();
        });

        $this->dispatch('flashMessage', type: 'success', message: 'Bình luận đã được xóa thành công');
        $this->dispatch('refreshComment');
        $this->reset();
    }

    protected function deleteRepliesRecursively($comment)
    {
        foreach ($comment->replies as $reply) {
            $this->deleteRepliesRecursively($reply); // gọi đệ quy xóa reply cấp con

            $reply->likeComments()->detach(); // xóa likes
            $reply->delete(); // xóa reply
        }
    }



}
