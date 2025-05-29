<div class="container">
    <div class="row row--30">
        <div class="col-lg-4 mt_md--40 mt_sm--40">
            <aside class="rainbow-sidebar">
                <div class="rbt-single-widget widget_search mt--40">
                    <span class="widget-title fs-3">Tìm kiếm câu lạc bộ</span>
                    <div class="inner">
                        <form class="blog-search" action="#">
                            <input wire:model.live="search" type="text" placeholder="Tìm kiếm CLB...">
                            <button class="search-button" disabled>
                                <i class='fa fa-search'></i>
                            </button>
                        </form>
                    </div>
                </div>
            </aside>
        </div>
        <div class="col-lg-8">
            <div class="row mt_dec--30">
                <div class="col-lg-12">
                    <div class="row row--15">
                        @if($clubs->isEmpty())
                            <div class="col-lg-12">
                                <div class="d-flex flex-column justify-content-center text-center align-items-center mt--150">
                                    <img src="{{asset('assets/client/images/bg/empty.jpg')}}" alt="" style="max-width: 400px; object-fit: cover;" >
                                    <div style="font-size: 18px; padding-top: 15px">Không tìm thấy bài viết nào.</div>
                                </div>
                            </div>
                        @else
                            @foreach($clubs as $club)
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt--30">
                                    <div class="rainbow-card box-card-style-default">
                                        <div class="inner">
                                            <div class="thumbnail"><a class="image" href="{{route('client.page-club',$club->id)}}"><img src="{{$club->banner==null?asset('storage/'.$club->thumbnail):asset('storage/'.$club->banner)}}" alt="Blog Image"></a></div>
                                            <div class="content pt--0" style="height: 130px">
                                                <h4 class="title mb--5"><a href="{{route('client.page-club',$club->id)}}">{{$club->name}}</a>
                                                </h4>
                                                <ul class="rainbow-meta-list d-flex justify-content-between" style="flex-wrap: nowrap">
                                                    <li style="width: 85%">{{$club->description}}</li>
                                                    <li class="ps-2" style="width: 15%;">
                                                        @if(Auth::check())
                                                            @if($club->likes()->where('user_id', auth()->user()->id)->exists()) <i style="color: red; font-size: 18px" class='fa fa-heart'></i>
                                                            @else
                                                                <i style="color: red; font-size: 18px" class='fa fa-heart-o'></i>
                                                            @endif
                                                        @else
                                                            <i style="color: red; font-size: 18px" class='fa fa-heart-o'></i>
                                                        @endif

                                                        <span class="ms-2" style="font-size: 18px">{{$club->likes_count}}</span>
                                                    </li>
                                                </ul>
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
                            {{$clubs->links('vendor.pagination.custom')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
