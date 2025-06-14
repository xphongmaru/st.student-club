<div class="rainbow-blog-details-area">
    <div class="post-page-banner rainbow-section-gapTop" style="padding-top: 20px !important">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="content text-center">
                        <div class="page-title">
                            <h4 class="">{{$notification->title}}</h4>
                        </div>
                        <ul class="rainbow-meta-list">
                            <li>
                                <i class='fa fa-group'></i>
                                <span> Thông báo từ câu lạc bộ {{$notification->club->name}}</span>
                            </li>
                            <li>
                                <i class="fa fa-user-o"></i>
                                <span> By {{$notification->getSender()->full_name}} - {{$notification->getSender()->getRoleClub($notification->club_id, $notification->getSender()->id)->name}}</span>
                            </li>
                            <li class="mt-2">
                                <i class="fa fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($notification->created_at)->locale('vi')->isoFormat('hh:mm - DD MMMM YYYY') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-details-content pt--30 rainbow-section-gapBottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="content">
                        {!! $notification->content !!}
                    </div>
                </div>
                @if($notification->attachments->isNotEmpty())
                    <div class="col-lg-6 offset-lg-2" style="margin: auto">
                        <span class="fw-bold">Tệp đính kèm:</span>
                        <ul class="list-group">
                            @foreach($notification->attachments as $file)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $file->name }}
                                    <a href="{{ asset('storage/' . $file->path) }}"  target="_blank" download="{{$file->name}}" class="btn btn-default" style="padding: 0 5px; height: 36px; line-height: 36px;">
                                        <i class='fa fa-download'></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                @endif
            </div>
        </div>
    </div>
</div>
