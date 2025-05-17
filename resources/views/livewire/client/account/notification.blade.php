<div>
    <div class="card-body">
        <div class="title d-flex justify-content-between" style="padding-bottom: 5px">
            <span class="ps-3">Thông báo </span>
            @if($hasNotification>0)
            <button wire:click="ReadAllNoti" class="btn-default" style="padding: 10px 15px; line-height: 20px; height: 40px; font-size: 16px" >Đánh dấu đã đọc Tất cả</button>
            @endif
        </div>
        <div class="table-responsive">
            @if($notifications->isEmpty())
                <div class="text-center">
                    <img src="{{ asset('assets/admin/images/empty.png') }}" alt="Không tìm thấy kết quả" style="width: 400px;" />
                </div>
            @else
                <ul style="list-style: none; cursor: pointer">
                    @foreach($notifications as $notification)
                        <li >
                            <div class="d-flex notification mt--10 p-4 @if($notification->is_read == 0) noti-isRead @endif" wire:click="read({{$notification->id}})">
                                <div class="noti-avatar" style="width: 10%;"><img src="{{asset('storage/'.$notification->club->thumbnail)}}" alt="" ></div>
                                <div class="noti-content ms-4" style="width: 80%;">
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
                        <div class="d-flex justify-content-center align-items-center w-100 mt-3" style="font-size: 16px">
                            <div class="pagination">
                                {{ $notifications->links() }}
                            </div>
                        </div>
                </ul>

            @endif
        </div>

    </div>
</div>
