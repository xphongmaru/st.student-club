<div>
    <div class="col-lg-12 sal-animate club">
        <div class="service bg-color-blackest radius text-center rbt-border">
            <div class="header">
                <div class="name-club d-flex" >
                    <h4 class="title w-600 me-3" >{{$club->name}}</h4>
                    @if(Auth::check())
                        @if(Auth::user()->hasPermissonClub('Quản lý trang CLB', $club->id))
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#clubDescription" class="btn btn-default btn-icon me-3" style="background-color: #ffa200">
                                <span>Sửa thông tin</span>
                            </a>
                        @endif
                    @endif
                </div>
                <div class="btn-join">
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#join-clb" class="btn-default round">Đăng ký tham gia CLB</a>
                </div>
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
                    <div class="col-lg-4">
                        <div class="description">
                            <div class="description-title">
                                <i class='fa fa-globe'></i> Các trang web và liên kết mạng xã hội
                            </div>
                            <div class="description-content">
                                <ul class="description-list">
                                    <li class="description-item d-flex align-items-center">
                                        <img src="{{asset('assets/client/images/icons/tiktok.png')}}" alt="">
                                        <a href="https://www.tiktok.com">https://www.tiktok.com</a>
                                    </li>
                                    <li class="description-item d-flex align-items-center">
                                        <img src="{{asset('assets/client/images/icons/facebook.png')}}" alt="">
                                        <a href="https://www.tiktok.com">https://www.facebook.com</a>
                                    </li>
                                    <li class="description-item d-flex align-items-center">
                                        <img src="{{asset('assets/client/images/icons/instagram.png')}}" alt="">
                                        <a href="https://www.tiktok.com">https://www.instagram.com</a>
                                    </li>
                                    <li class="description-item d-flex align-items-center">
                                        <img src="{{asset('assets/client/images/icons/youtube.png')}}" alt="">
                                        <a href="https://www.tiktok.com">https://www.youtube.com</a>
                                    </li>
                                    <li class="description-item d-flex align-items-center">
                                        <img src="{{asset('assets/client/images/icons/link.png')}}" alt="">
                                        <a href="https://www.tiktok.com">https://www.link.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

