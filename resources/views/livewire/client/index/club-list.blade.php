<div>
    <div class="row row--15">
        @if($clubs==null)
            <div style="text-align: center; font-size: 18px">Không có câu lạc bộ nổi bật.</div>
        @endif
        @foreach($clubs as $club)
        <div class="col-lg-4 col-md-6 col-sm-12 col-12 mt--30" data-sal="slide-up" data-sal-duration="700">
            <div class="rainbow-card box-card-style-default">
                <div class="inner">
                    <div class="thumbnail"><a class="image" href="{{route('client.page-club',$club->id)}}"><img src="{{$club->banner==null?asset('storage/'.$club->thumbnail):asset('storage/'.$club->banner)}}" alt="Blog Image"></a></div>
                    <div class="content pt--0 justify-content-between" style="height: 200px">
                        <h4 class="title mb--5"><a href="{{route('client.page-club',$club->id)}}">{{$club->name}}</a>
                        </h4>
                        <ul class="rainbow-meta-list">
                            <li>{{$club->description}}</li>
                        </ul>
                        <div class="d-flex justify-content-between mt--10 pb--20" style="width: 100%">
                            <div class="ms-3">
                                @if(Auth::check())
                                    @if($club->likes()->where('user_id', auth()->user()->id)->exists()) <i style="color: red; font-size: 18px" class='fa fa-heart'></i>
                                    @else
                                        <i style="color: red; font-size: 18px" class='fa fa-heart-o'></i>
                                    @endif
                                @else
                                    <i style="color: red; font-size: 18px" class='fa fa-heart-o'></i>
                                @endif
                                <span class="ms-2 fs-3">{{$club->likes_count}}</span>
                            </div>
                            <div class="right-button me-3">
                                <a class="btn-read-more" href="{{route('client.page-club',$club->id)}}">
                                    <span>Xem thêm <i data-feather="arrow-right"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
