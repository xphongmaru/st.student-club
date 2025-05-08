<div>
    <div class="content">
        <div class="row">
            @foreach($clubs as $club)
            <div class="col-sm-6 col-xl-4">
                <div class="card">
                    <div class="card-img-actions mx-1 mt-1">
                        <img class="card-img img-fluid" src="{{asset('storage/'.$club->thumbnail)}}" alt="" style="height: 240px; object-fit: cover">
                        <div class="card-img-actions-overlay card-img">
    {{--                            <a href="#" class="btn btn-outline-white btn-icon rounded-pill" data-bs-popup="lightbox" data-gallery="gallery1">--}}
    {{--                                <i class="ph-plus"></i>--}}
    {{--                            </a>--}}
                            <button wire:click="manageClub({{$club->id}})" class="btn btn-outline-white btn-icon rounded-pill ms-2">
                                <i class="ph-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-start flex-nowrap">
                            <div>
                                <div class="fw-semibold me-2">{{$club->name}}</div>
                                <span class="fs-sm text-muted">Chức vụ: {{$club->getRoleClub($club->id, Auth::user()->id)->name}}</span>
                            </div>

                            <div class="d-inline-flex ms-auto">
                                <button wire:click="manageClub({{$club->id}})" class="text-body" style="border: none; background: transparent"><i class="ph-wrench"></i> Quản lý</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
