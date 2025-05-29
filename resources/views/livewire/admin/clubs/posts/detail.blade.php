<div class="d-flex align-items-stretch align-items-lg-start flex-column flex-lg-row">

    <!-- Left content -->
    <div class="flex-1 order-2 order-lg-1">

        <!-- Post -->
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    {!! $post->content !!}
                </div>

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
                <div class="sidebar-section-header border-bottom">
                    <span class="fw-semibold">Thông tin bài viết </span>
                </div>

                <div class="sidebar-section-body px-2">
                    <img src="{{asset('storage/'.$post->thumbnail)}}" alt=""  style="max-height: 150px; max-width: 100%; object-fit: cover">
                </div>
                <div class="sidebar-section-body pt-0 px-2">
                    <ul style="list-style: none; padding: 0">
                        <li>
                            <span class="fw-bold"> <i class="ph-note"></i> Tiêu đề: </span>
                            <span class="ps-2 d-block">{{$post->title}}</span>
                        </li>
                        <li class="mt-3">
                            <span class="fw-bold"> <i class="ph-stack"></i> Danh mục: </span>
                            <span class="ps-2 d-block">{{$post->categoryPost->name}}</span>
                        </li>
                        <li class="mt-3">
                            <span class="fw-bold"> <i class="ph-user-circle"></i>  viết bài: </span>
                            <span class="">{{$post->user->full_name}}</span>
                        </li>
                        <li class="mt-3">
                            @php
                                $postEnum = App\Enums\StatusPost::mapValue($post->status);
                            @endphp
                            <span class="fw-bold"> <i class="ph-user-circle"></i>  Trạng thái: </span>
                            <span class="py-1
                                 @switch($postEnum)
                                    @case(App\Enums\StatusPost::pending) badge bg-warning @break
                                    @case(App\Enums\StatusPost::approved) badge bg-info @break
                                    @case(App\Enums\StatusPost::rejected) badge bg-danger @break
                                    @case(App\Enums\StatusPost::scheduled) badge bg-info @break
                                    @case(App\Enums\StatusPost::published) badge bg-success @break
                                    @case(App\Enums\StatusPost::private) badge bg-primary @break
                                    @case(App\Enums\StatusPost::draft) badge bg-yellow @break
                                 @endswitch
                            ">{{$postEnum->label()}}</span>
                        </li>
                        @if($post->status == App\Enums\StatusPost::published->name)
                            <li class="mt-3">
                                <span class="fw-bold"> <i class="ph-calendar"></i>  Ngày xuất bản: </span>
                                <span class="d-block ps-2">{{$post->publicDate}}</span>
                            </li>
                        @endif
                    </ul>

                </div>
            </div>
            <!-- /search -->
            <div class="card" style="width: 80%;">
                <div class="sidebar-section-header border-bottom">
                    <span class="fw-semibold">Thông số</span>
                </div>

                <div class="nav nav-sidebar" >
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="ph-heart me-2"></i>
                            Lượt like
                            <span class="text-muted fs-sm fw-normal ms-auto">{{$post->likes_count}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="ph-file-video me-2"></i>
                            Lượt bình luận
                            <span class="text-muted fs-sm fw-normal ms-auto">{{$post->comments()->count()   }}</span>
                        </a>
                    </li>
                </div>
            </div>

        </div>
        <!-- /sidebar content -->

    </div>
    <!-- /right sidebar component -->

</div>
