<div class="row mt_dec--30">
    <div class="col-lg-12">
        <div class="row row--15">
            @foreach($posts as $post)
                <div class="col-lg-6 mt--30">
                    <div class="rainbow-card box-card-style-default card-list-view">
                        <div class="inner">
                            <div class="thumbnail">
                                <a class="image" href="{{route('client.club.post-detail',['id'=>$club->id, 'slug'=>$post->slug])}}">
                                    <img src="{{asset('storage/'.$post->thumbnail)}}" alt="Post Image" style="height: 200px; object-fit: cover; width: 100%">
                                </a>
                            </div>
                            <div class="content">
                                <h4 class="title" style="margin: -10px 0 ">
                                    <a href="{{route('client.club.post-detail',['id'=>$club->id, 'slug'=>$post->slug])}}">{{$post->title}}</a>
                                </h4>
                                <ul class="rainbow-meta-list mt-3" style="padding-top: 12px">
                                    <li><a href="javascript:void(0)">{{$post->user->full_name}}</a></li>
                                    <li class="separator">/</li>
                                    <li>{{ \Carbon\Carbon::parse($post->publicDate)->locale('vi')->isoFormat('HH:mm DD MMMM YYYY') }}</li>
                                </ul>
                                <div style="width: 100%">
                                    <span class="descriptiion">{{$post->sort_content!=''?$post->sort_content:'...'}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-lg-12">
        <div class="rainbow-load-more text-center mt--40">
            <a href="{{route('client.club.post',['id'=>$club->id])}}" class="btn btn-default btn-icon round">
                                <span>Xem thêm
                                    <span class="icon">
                                        <i data-feather="arrow-right"></i>
                                        </span>
                                    </span>
            </a>
        </div>
    </div>
</div>
