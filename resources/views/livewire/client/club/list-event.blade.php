<div class="container" wire:ignore>
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title text-center" data-sal="slide-up" data-sal-duration="700" data-sal-delay="100">
                <h2 class="title w-600 mb--20">Các hoạt động của câu lạc bộ</h2>
            </div>
        </div>
    </div>
    <div id="owl-demo" class="owl-carousel owl-theme">
        @foreach($events as $event)
            <div class="item">
                <div class="cmt--30" data-sal="slide-up" data-sal-duration="700">
                    <div class="rainbow-card box-card-style-default">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#quickViewEvent" wire:click="quickViewEvent({{$event->id}})">
                            <div class="inner" >
                                <div class="thumbnail"><img src="{{asset('storage/'.$event->thumbnail)}}" alt="Blog Image" style="height: 180px; object-fit: cover"></div>
                                <div class="content pt--0">
                                    <h4 class="title mb--5">{{$event->name}}
                                    </h4>
                                    <ul class="rainbow-meta-list">
                                        <li>{{$event->description}}</li>
                                    </ul>
                                    <div class="mt--10" style="width: 100%">
                                        <div class="ms-1">
                                            <i style="color: var(--color-vnua);" data-feather="calendar"></i>
                                            <h5 class="ms-2" style="font-size: 16px; font-weight: 500; display: inline-block">{{\Carbon\Carbon::parse($event->event_date)->format('d-m-Y')}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
