<li>
    @if($comment)
        <div class="d-flex">
            <img class="me-4" src="{{ $comment->user->thumbnail==null? asset('assets/client/images/user/default-user-image.png'):asset('storage/'.$comment->user->thumbnail) }}" alt="" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover">
            <div class="ms-2" style="width: 100%">
                <div>
                <span class="fw-bold me-4" style="font-size: 16px; color: var(--color-vnua)">
                    {{ $comment->user->full_name ?? 'Người dùng' }}
                </span>
                    <span class="ms-2 fw-light" style="font-size: 13px">{{ $comment->created_at }}</span>
                </div>
                <div>
                    <span style="font-size: 16px">{{ $comment->content }}</span>
                </div>
                <div class="d-flex justify-content-start" style="font-size: 15px; margin-top: 10px">
                <span class="me-5" style="cursor: pointer; -webkit-user-select: none" wire:click="handleLike({{$comment->id}})">
                    @if($comment->likeComments()->where('user_id', Auth::id())->exists()) <i class="fa fa-thumbs-up me-2"></i>@else <i class="fa fa-thumbs-o-up me-2"></i> @endif {{ $comment->likes_count}}
                </span>
                    <span class="me-5" style="cursor: pointer; -webkit-user-select: none" wire:click="replies">Trả lời</span>
                    @auth
                        @if(Auth::id() == $comment->user_id)
                            <span class="me-2 text-danger cursor-pointer" style="cursor: pointer; -webkit-user-select: none" wire:click="deleteComment({{$comment->id}})">Xóa</span>
                        @endif
                    @endauth
                </div>

                @auth
                    @if($togleReply)
                        <livewire:client.club.post.comment-form :parentId="$comment->id" :post="$post" />
                    @endif
                @endauth

                @if($comment->replies()->count() > 0)
                    <ul style="list-style: none; margin-left: -20px">
                        @foreach($this->replies as $reply)
                            <livewire:client.club.post.comment-item :comment="$reply" :post="$post" :key="$reply->id"/>
                        @endforeach
                    </ul>

                    @if($comment->replies()->count() > count($this->replies))
                        <div class="d-flex justify-content-center">
                            <button wire:click="loadMoreReplies" class="btn fw-bold" style="color: var(--color-vnua); margin-top: 10px; padding: 5px 10px; font-size: 16px">
                                Xem thêm {{ $comment->replies()->count() - count($this->replies) }} phản hồi
                            </button>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    @endif
</li>
