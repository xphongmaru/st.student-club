<div class="d-flex align-items-stretch align-items-lg-start flex-column flex-lg-row">

    <!-- Left content -->
    <div class="flex-1 order-2 order-lg-1">

        <!-- Post -->
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    {!! $notification->content !!}
                </div>
                @if($notification->attachments->isNotEmpty())
                        <span class="fw-bold">Tệp đính kèm:</span>
                        <ul class="list-group mt-2">
                            @foreach($notification->attachments as $file)
                                <li class="list-group-item d-flex justify-content-between align-items-center py-1">
                                    {{ $file->name }}
                                    <a href="{{ asset('storage/' . $file->path) }}"  target="_blank" download="{{$file->name}}" class="btn btn-default text-success" style="padding: 0 5px; height: 36px; line-height: 36px;">
                                        <i class='fa fa-download'></i> Tải xuống
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                @endif
            </div>
        </div>
        <!-- /post -->
    </div>
    <!-- /left content -->


    <!-- Right sidebar component -->
    <div class="sidebar sidebar-component sidebar-expand-lg bg-transparent shadow-none order-1 order-lg-2 ms-lg-3 mb-3">

        <!-- Sidebar content -->
        <div class="sidebar-content">

            <!-- Search -->
            <div class="card" style="width: 80%;">
                <div class="sidebar-section-header border-bottom d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">Thông tin thông báo </span>
                    <a href="{{ route('admin.club.notification-index',['id'=>$club_id]) }}" type="button" class=""><i class="ph-arrow-bend-down-left"></i> Trở lại</a>
                </div>

                <div class="sidebar-section-body pt-0 px-2 mt-2">
                    <ul style="list-style: none; padding: 0">
                        <li>
                            <span class="fw-bold"> <i class="ph-note"></i> Tiêu đề: </span>
                            <span class="ps-2 d-block">{{$notification->title}}</span>
                        </li>
                        <li class="mt-3">
                            <span class="fw-bold"> <i class="ph-calendar"></i>  Ngày phát thông báo: </span>
                            <span class="d-block ps-2">{{$notification->created_at}}</span>
                        </li>
                        <li class="mt-3">
                            <span class="fw-bold"> <i class='ph ph-list-checks'></i>  Danh sách thành viên: </span>
                            <ul style="list-style: none; padding-left: 10px" class="mt-1">
                                @foreach($roles as $role)
                                    @php($users = $role->user()->get())
                                    <li class="fw-bold">{{$role->name}} </li>
                                    @foreach($users as $user)
                                        @php($pivotUser = $notification->notificationUsers->firstWhere('id', $user->id))
                                        <li class="ms-2 d-flex justify-content-between">
                                            <span>{{ $user->full_name }}</span>
                                            @if($notification->sender_id == $user->id)
                                                <i class="text-warning"> Người đăng </i>
                                            @elseif($pivotUser && $pivotUser->pivot->is_read == 1)
                                                <i class="text-success">Đã đọc</i>
                                            @else
                                                <i class="text-danger">Chưa đọc</i>
                                            @endif
                                        </li>
                                    @endforeach

                                @endforeach
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- /search -->

        </div>
        <!-- /sidebar content -->

    </div>
    <!-- /right sidebar component -->

</div>
