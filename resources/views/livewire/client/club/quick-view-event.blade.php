<div>

    <div class="modal-content">

        <div class="logo-mini">
            <img src="{{asset('storage/'.$club->thumbnail)}}" alt="">
        </div>
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thông tin sự kiện của Câu lạc bộ </h5>
            <a href="javascript:void(0)" data-bs-dismiss="modal" aria-label="Close">X</a>
        </div>
        <div class="quick-veiw-area">
            <div style="display: flex; justify-content: center; align-items: center;">
                <div wire:loading>
                    <div style="margin: 200px 0;font-size: 20px; color: var(--color-vnua);">
                        <i class="fa fa-spinner fa-spin"></i> Đang tải...
                    </div>
                </div>
            </div>

            <div wire:loading.remove>
                <div class="px-15 pt-3 pb-5" style="padding: 30px 40px">
                    @if($event != null)
                        <div class="d-flex event-content">
                            <div style="width: 40%; height: 300px; margin-right: 30px; margin-bottom: 20px">
                                <img src="{{asset('storage/'.$event->thumbnail)}}" alt="Blog Image" style="width: 100%; height: 300px; object-fit: cover; border-radius: 3px;">
                            </div>
                            <div style="width: 60%;">
                                <h5 class="mb-3" style="font-weight: 600; font-size: 20px;">{{$event->name}}</h5>
                                <div class="d-flex align-items-center">
                                    <i style="color: var(--color-vnua);" class="fa fa-calendar"></i>
                                    <p class="ms-2 mb-0 " style="font-size: 16px; font-weight: 500; display: inline-block">{{\Carbon\Carbon::parse($event->event_date)->format('d-m-Y')}}</p>
                                </div>
                                <p class="mb-3">{{$event->description}}</p>
                            </div>
                        </div>
                    @endif

                </div>
                <!-- Start Gallery Small Style-3  -->
                <div class="rainbow-gallery-area rainbow-section-gapBottom" style="padding:0 30px 30px 30px !important;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 mb--20">
                                <div class="section-title text-center" data-sal-duration="700" data-sal-delay="100">
                                    <h4 class="title w-600 mb--20">Một số hình ảnh về sự kiện </h4>
                                </div>
                            </div>
                        </div>
                        @if($photos!=null && count($photos) > 0)
                            <div class="row mt_dec--30 row--15" id="animated-lightbox3" style="margin-top: -40px" >
                                @foreach($photos as $photo)
                                    <a class="col-lg-4 col-md-6 col-sm-6 col-12 mt--30" href="{{asset('storage/'.$photo->path)}}">
                                        <div class="rainbow-gallery icon-center">
                                            <div class="thumbnail">
                                                <img class="radius-small" src="{{asset('storage/'.$photo->path)}}" alt="Corporate Image" style="height: 250px; object-fit: cover;">
                                            </div>
                                            <div class="video-icon">
                                                <div class="btn-default rounded-player sm-size">
                                        <span>
                                            <i class="fa fa-search-plus"></i>
                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center" style="font-size: 20px; color: var(--color-vnua);">
                                <i class="fa fa-exclamation-triangle"></i> Không có thêm hình ảnh nào về sự kiện.
                            </div>
                        @endif
                    </div>
                </div>
                <!-- Fnd Gallery Small Style-3  -->
            </div>
        </div>
    </div>
</div>
