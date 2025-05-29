<div class="container">
    <div class="row row--30">
        <div class="col-lg-4 mt_md--40 mt_sm--40">
            <aside class="rainbow-sidebar">
                <div class="rbt-single-widget widget_search mt--40">
                    <div class="inner">
                        <form class="blog-search" action="#">
                            <input wire:model.live="search" type="text" placeholder="Tìm kiếm bài viết...">
                            <button class="search-button" disabled>
                                <i class='fa fa-search'></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="rbt-single-widget widget_categories mt--40">
                    <h3 class="title">Danh mục bài viết</h3>
                    <div class="inner">
                        <ul class="category-list ">
                            @foreach($clubs as $club)
                                <li class="d-flex justify-content-between">
                                    <div>
                                        <input type="checkbox" value="{{ $club->id }}" class="" style="width: 20px; height: 20px; accent-color: green; opacity: 1;" wire:model.live="selectedClubs">
                                        <a href="{{route('client.club.post',['id'=>$club->id])}}" class="ms-5" style="font-size: 16px; line-height: 20px">{{ $club->name }}</a>
                                    </div>
                                    <span class="count">({{ $club->posts->where('status', 'published')->count() }})</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="rbt-single-widget widget_recent_entries mt--40">
                    <h3 class="title">Bài viết nổi bật</h3>
                    <div class="inner">
                        <ul>
                            @foreach($postFamous as $item)
                                <li>
                                    <a class="d-block" href="{{route('client.club.post-detail',['id'=>$item->club_id, 'slug'=>$item->slug])}}">
                                        {{$item->title}}
                                    </a>
                                    <span class="cate">{{$item->user->full_name}}</span>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </aside>
        </div>
        <div class="col-lg-8">
            <div class="row mt_dec--30">
                <div class="col-lg-12">
                    <div class="row row--15">
                        @if($posts->isEmpty())
                            <div class="col-lg-12">
                                <div class="d-flex flex-column justify-content-center text-center align-items-center mt--150">
                                    <img src="{{asset('assets/client/images/bg/empty.jpg')}}" alt="" style="max-width: 400px; object-fit: cover;" >
                                    <div style="font-size: 18px; padding-top: 15px">Không tìm thấy bài viết nào.</div>
                                </div>
                            </div>
                        @else
                            @foreach($posts as $post)
                                <div class="col-lg-6 col-md-6 col-12 mt--30">
                                    <div class="rainbow-card undefined">
                                        <div class="inner">
                                            <div class="thumbnail">
                                                <a class="image" href="{{route('client.club.post-detail',['id'=>$post->club_id, 'slug'=>$post->slug])}}">
                                                    <img src="{{asset('storage/'.$post->thumbnail)}}" alt="Blog Image">
                                                </a>
                                            </div>
                                            <div class="content" style="height: 130px">
                                                <ul class="rainbow-meta-list">
                                                    <li><span>{{$post->user->full_name}}</span></li>
                                                    <li class="separator">/</li>
                                                    <li>{{ \Carbon\Carbon::parse($post->publicDate)->locale('vi')->isoFormat('DD MMMM YYYY') }}</li>
                                                </ul>
                                                <h4 class="title"><a href="{{route('client.club.post-detail',['id'=>$post->club_id, 'slug'=>$post->slug])}}">{{$post->title}}</a></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                    <div class="rainbow-load-more text-center mt--60 justify-content-center d-flex">
                        <div class="pagination">
                            {{$posts->links('vendor.pagination.custom')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
