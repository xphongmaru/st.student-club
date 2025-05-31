<div class="d-flex align-items-stretch align-items-lg-start flex-column flex-lg-row">

    <!-- Left content -->
    <div class="flex-1 order-2 order-lg-1">

        <!-- Post -->
        <div class="card">
            <div class="card-body">

                <div class="sidebar-section-body px-2 text-center">
                    <img src="{{asset('storage/'.$event->thumbnail)}}" alt=""  style="max-height: 500px; max-width: 100%; object-fit: cover">
                </div>
                <div class="mb-2 text-center mt-3">
                    <h4>{{$event->name}}</h4>
                </div>
                <div class="px-5">
                    <span style="font-size: 16px">{!! $event->description !!}</span>
                </div>
            </div>

            <div class="px-5">
                <div class="mb-3">
                    <h6 class="mb-0">Một số hình ảnh về sự kiện</h6>
                </div>

                <div class="row">
                    @foreach($photos as $photo)
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <div class="card-img-actions m-1">
                                    <img class="card-img img-fluid" src="{{asset('storage/'.$photo->path)}}" alt="" style="height: 200px; object-fit: cover">
                                    <div class="card-img-actions-overlay card-img">
                                        <a href="{{asset('storage/'.$photo->path)}}" target="_blank" class="btn btn-outline-white btn-icon rounded-pill" data-bs-popup="lightbox" data-gallery="gallery1">
                                            <i class="ph-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- /post -->

    </div>
    <!-- /left content -->

</div>
