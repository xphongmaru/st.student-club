<div class="col-lg-8 offset-lg-2 comment" >
    <div class="d-flex justify-content-between" style="border-bottom: 1px solid var(--color-gray); padding: 10px">
        <span class="ms-3">Bình luận</span>
        <span class="me-3">{{$post->comments()->count()}} lượt bình luận</span>
    </div>
    <div>
        @if(Auth::check())
            <livewire:client.club.post.comment-form :post="$post"/>
        @else
            <div class="alert alert-danger" role="alert" style="margin: 20px">
                <strong>Chú ý!</strong> Bạn cần đăng nhập để có thể bình luận.
            </div>
        @endif
        <div>
            <ul style="list-style: none">
                @foreach($comments as $comment)
                    <livewire:client.club.post.comment-item :comment="$comment" :post="$post" :key="$comment->id"/>
                @endforeach
            </ul>
        </div>
        @if($comments->count() >= $perPage)
            <div class="d-flex justify-content-center" style="margin: 20px">
                <button wire:click="loadMore" wire:loading.attr="disabled" class="btn btn-default">
                    <span wire:loading.remove wire:target="loadMore">Xem thêm bình luận</span>
                    <span wire:loading wire:target="loadMore">
                        <i class="fa fa-spinner fa-spin me-2"></i> Đang tải...
                    </span>
                </button>
            </div>
        @endif
    </div>
</div>

