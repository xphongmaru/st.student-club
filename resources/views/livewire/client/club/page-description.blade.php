<div>
    <div class="col-lg-12 sal-animate club">
        <div class="service bg-color-blackest radius text-center rbt-border">
            <div class="header">
                <div class="name-club d-flex" >
                    <h4 class="title w-600 me-3" >{{$club->name}}</h4>
                    @if(Auth::check())
                        @if(Auth::user()->hasPermissonClub('Quản lý trang CLB', $club->id))
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#clubDescription" class="btn btn-default btn-icon me-3 mt-2" style="background-color: #ffa200; padding: 0 10px; height: 40px; line-height: 36px">
                                <span>Sửa thông tin</span>
                            </a>
                        @endif
                    @endif
                </div>
                @if($recruitmentClubs)
                    <div class="btn-join">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#join-clb" class="btn-default round">Đăng ký tham gia CLB</a>
                    </div>
                @endif
            </div>
            <div class="row content">
                <div class="col-12">
                    <div class="description">
                        <div class="description-title">
                            <i data-feather="bookmark"></i> Mô tả câu lạc bộ
                        </div>
                        <div class="description-content">
                            <span>{{$club->description==null?"<trống>":$club->description}}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if($club->foundation_date)
                        <div class="mt-5 col-lg-4">
                            <div class="description">
                                <div class="description-title">
                                    <i class='fa fa-calendar'></i> Ngày thành lập
                                </div>
                                <div class="description-content ms-5">
                                    <span>{{\Carbon\Carbon::parse($club->foundation_date)->format('d-m-Y')}}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($club->field_of_activity)
                        <div class="mt-5 col-lg-4">
                            <div class="description">
                                <div class="description-title">
                                    <i class='fa fa-bookmark'></i> Lĩnh vực hoạt động
                                </div>
                                <div class="description-content ms-5">
                                    <span>{{$club->field_of_activity}}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($club->address)
                        <div class="mt-5 col-lg-4">
                            <div class="description">
                                <div class="description-title">
                                    <i class='fa fa-map-marker'></i> Địa điểm
                                </div>
                                <div class="description-content ms-5">
                                    <span>{{$club->address}}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($club->email)
                        <div class="mt-5 col-lg-4">
                            <div class="description">
                                <div class="description-title">
                                    <i class='fa fa-envelope-o'></i> Email
                                </div>
                                <div class="description-content ms-5">
                                    <span>{{$club->email}}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                        @if($club->phone)
                            <div class="mt-5 col-lg-4">
                                <div class="description">
                                    <div class="description-title">
                                        <i class='fa fa-phone'></i> Số điện thoại
                                    </div>
                                    <div class="description-content ms-5">
                                        <span>{{$club->phone}}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                </div>
                <div class="row mt-5">
                    <div class="col-lg-6">
                        <div class="description">
                            <div class="description-title">
                                <i class='fa fa-globe'></i> Các trang web và liên kết mạng xã hội
                            </div>
                            <div class="description-content">
                                <ul class="description-list">
                                    @foreach($websites as $website)
                                        <li class="description-item d-flex align-items-center">
                                            <img src="{{asset($website->icon->thumbnail)}}" alt="">
                                            <a href="{{$website->url}}">{{$website->url}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

