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
                    <img src="{{ asset('assets/admin/images/empty.png') }}" alt="Không tìm thấy kết quả" style=" width: 400px;" />
                </div>
            @else
                <ul style="list-style: none; cursor: pointer">
                    @foreach($notifications as $notification)
                        <li >
                            <div class="d-flex notification mt--10 p-4 @if($notification->pivot->is_read == 0) noti-isRead @endif" style="z-index: 1">
                                <div wire:click="read({{$notification->id}})" class="d-flex">
                                    <div class="noti-avatar" style="width: 10%;"><img src="{{asset('storage/'.$notification->club->thumbnail)}}" alt="" ></div>
                                    <div class="noti-content ms-4" style="width: 80%;">
                                        <span class="mb-2 noti-title">@if($notification->type=='new_notification_club') {{'Bạn nhận được một thông báo mới từ CLB '.$notification->club->name }}@else {{$notification->title}} @endif</span>
                                        <span class="noti-cont">@if($notification->type=='new_notification_club') {{$notification->title }}@else {{ $notification->content}}@endif</span>
                                        <span class="noti-date">{{ $notification->created_at->format('H:i d/m/Y') }}</span>
                                    </div>
                                </div>
                                @if($notification->pivot->is_read == 0)
                                    <div class="isRead">
                                    </div>
                                @endif
                                <div class="dropdown text-center modeFN" style="margin-top: 12px">
                                    <a class="javascript:void(0)" type="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="event.stopPropagation()" style="-webkit-user-select: none; padding: 0px 10px; border-radius: 45%; background-color: #f0f0f0; color: #333; font-size: 24px; line-height: 24px">
                                        <i class='fa fa-ellipsis-h'></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><button class="dropdown-item" wire:click="deleteNoti({{$notification->id}})">Xóa thông báo này </button></li>
                                        @if($notification->pivot->is_read == 0)<li><button class="dropdown-item" wire:click="readNoti({{$notification->id}})">Đánh dấu là đã đọc</button></li>@endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endforeach
                        @if($notifications->count() >= $take)
                            <div class="d-flex justify-content-center align-items-center w-100 mt-3" style="font-size: 16px">
                                <div class="pagination">
                                    <button wire:click="loadMore" wire:loading.attr="disabled" class="btn btn-default">
                                        <span wire:loading.remove wire:target="loadMore">Xem thêm thông báo</span>
                                        <span wire:loading wire:target="loadMore">
                                            <i class="fa fa-spinner fa-spin me-2"></i> Đang tải...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        @endif
                </ul>

            @endif
        </div>

    </div>
</div>
