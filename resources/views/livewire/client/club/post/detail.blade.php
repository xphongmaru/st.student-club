<div class="rainbow-blog-details-area">
    <div class="post-page-banner rainbow-section-gapTop" style="padding-top: 20px !important">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="content text-center">
                        <div class="page-title">
                            <h4 class="">{{$post->title}}</h4>
                        </div>
                        <ul class="rainbow-meta-list">
                            <li>
                                <i class="fa fa-user-o"></i>
                                <span href="#"> By {{$post->user->full_name}}</span>
                            </li>
                            <li>
                                <i class="fa fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($post->publicDate)->locale('vi')->isoFormat('DD MMMM YYYY') }}
                            </li>
                            <li wire:click="likePost" style="cursor: pointer; -webkit-user-select: none">
                                @if($this->post->likePosts()->where('user_id', auth()->id())->exists())
                                    <i class="fa fa-heart me-2" style="color: red"></i>
                                @else
                                    <i class="fa fa-heart-o me-2" style="color: red"></i>
                                @endif
                                {{ $post->likes_count }}
                            </li>
                        </ul>
                        <div class="thumbnail alignwide mt--30"><img class="w-100 radius" src="{{asset('storage/'.$post->thumbnail)}}" alt="Blog Images"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-details-content pt--30 rainbow-section-gapBottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="content">
                        {!! $post->content !!}
                    </div>
                </div>

                <livewire:client.club.post.comment-list :post="$post"/>
            </div>
        </div>
    </div>
</div>
