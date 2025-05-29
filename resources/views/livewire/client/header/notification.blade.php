<div>
    <ul class="submenu">
        @if( auth()->check() && count($notifications) == 0)
            <li>
                <a class="link-login" href="{{route('client.account',['item'=>2])}}">
                    <div class="noti-no-login">
                        <img src="{{asset('assets\client\images\user\login.svg')}}" alt="">
                        <span>Bạn chưa có thông báo mới</span>
                    </div>
                </a>
            </li>
        @elseif(!auth()->check() && $notifications == null)
                <li>
                    <a class="link-login" href="{{route('sso.redirect')}}">
                        <div class="noti-no-login">
                            <img src="{{asset('assets\client\images\user\login.svg')}}" alt="">
                            <span>Đăng nhập để xem thông báo </span>
                        </div>
                    </a>
                </li>
        @else
            @foreach($notifications as $notification)
                <li >
                    <div class="d-flex notification @if($notification->is_read == 0) noti-isRead @endif" wire:click="read({{$notification->id}})">
                        <div class="noti-avatar"><img src="{{asset('storage/'.$notification->club->thumbnail)}}" alt="" ></div>
                        <div class="noti-content">
                            <span class="mb-2 noti-title">{{$notification->title}}</span>
                            <span class="noti-cont">{{ $notification->content}}</span>
                            <span class="noti-date">{{ $notification->created_at->format('H:i d/m/Y') }}</span>
                        </div>
                        @if($notification->is_read == 0)
                            <div class="isRead">
                            </div>
                        @endif
                    </div>
                </li>
            @endforeach
            @if(count($notifications)>=3)
            <div class="d-flex justify-content-center mt-2" style="font-size: 16px">
                <a href="{{route('client.account',['item'=>1])}}" class="btn-read-more">
                    <span>Xem thêm
                            <i data-feather="arrow-right"></i>
                        </span>
                </a>
            </div>
            @endif

        @endif
    </ul>
</div>
