<div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="content-header d-flex justify-content-between align-items-end">
                    <div class="content-filter w-50">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="form-group">
                                    <label for="user-search-input">Tìm kiếm</label>
                                    <div class="form-control-feedback form-control-feedback-end">
                                        <input wire:model.live="search" type="text" name="q"
                                               placeholder="Nhập vào thông tin tìm kiếm..."
                                               class="form-control" id="user-search-input">
                                        <div class="form-control-feedback-icon">
                                            <i class="ph-magnifying-glass"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-action d-flex">
                        <div id="dataTables_length"     class="me-3">
                            <label class="d-flex" style="align-items: center">
                                <span style="width: 100px;">Bộ lọc:</span>
                                <select wire:model.live="selectedStatus" aria-controls="DataTables_Table_0" class="form-select">
                                    <option value="" >Tất cả</option>
                                    @foreach($status as $item)
                                        <option value="{{$item->name}}" >{{$item->label()}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <a href="{{route('admin.club.post-create',['id'=>$club_id])}}" class="btn btn-teal"><i class="ph-plus-circle me-1"></i>Tạo mới</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="">
                    <div wire:loading class="my-3 text-center w-100">
                        <span class="spinner-border spinner-border-sm"></span> Đang tải dữ liệu...
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 1%">STT</th>
                            <th class="text-center" style="width: 10%">Ảnh đại diện bài viết</th>
                            <th class="text-center" style="width: 30%">Tiêu đề</th>
                            <th class="text-center" style="width: 30%">Nội dung ngắn</th>
                            <th class="text-center" style="width: 10%">Danh mục</th>
                            <th class="text-center" style="width: 10%">Người đăng</th>
                            <th class="text-center" style="width: 5%">Trạng thái</th>
                            <th class="text-center" style="width: 1%; text-align: center">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($posts->isEmpty())
                            <tr>
                                <td colspan="100%" class="text-center">
                                    <img src="{{ asset('assets/admin/images/empty.png') }}" alt="Không tìm thấy kết quả" style="width: 400px;" />
                                </td>
                            </tr>
                        @else
                            @foreach($posts as $post)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        @if($post->thumbnail != null)
                                            <img src="{{asset('storage/'.$post->thumbnail)}}" alt="" style="height: 80px">
                                        @else
                                            chưa có ảnh đại diện
                                        @endif
                                    </td>
                                    <td class="text-center">{{$post->title==null?'< chưa có tiêu đề >':$post->title}}</td>
                                    <td class="text-center" style="line-height: 18px; height: calc(20px * 8);; display: -webkit-box;-webkit-line-clamp: 8;-webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis">{{ $post->sort_content!=''?$post->sort_content: 'chưa có nội dung'}}</td>
                                    <td class="text-center">{{$post->category_post_id!=null?$post->categoryPost->name:'chưa có danh mục'}}</td>
                                    <td class="text-center">{{$post->user->full_name}}</td>
                                    @php
                                        $postEnum = App\Enums\StatusPost::mapValue($post->status);
                                    @endphp
                                    <td class="text-center">
                                    <span class="
                                        @switch($postEnum)
                                            @case(App\Enums\StatusPost::pending) badge bg-warning @break
                                            @case(App\Enums\StatusPost::approved) badge bg-info @break
                                            @case(App\Enums\StatusPost::rejected) badge bg-danger @break
                                            @case(App\Enums\StatusPost::scheduled) badge bg-info @break
                                            @case(App\Enums\StatusPost::published) badge bg-success @break
                                            @case(App\Enums\StatusPost::private) badge bg-primary @break
                                            @case(App\Enums\StatusPost::draft) badge bg-yellow @break

                                        @endswitch
                                    ">
                                        {{ $postEnum->label() }}
                                    </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a href="#" class="text-body" data-bs-toggle="dropdown">
                                                <i class="ph-list"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @if($post->status != App\Enums\StatusPost::draft->name)
                                                    <a href="{{ route('admin.club.post-detail', ['id' => $club_id, 'post_id'=> $post->id])}}" class="dropdown-item">
                                                        <i class="ph-eye me-2"></i>
                                                        Xem chi tiết
                                                    </a>
                                                @endif
                                                <a href="{{ route('admin.club.post-edit', ['id' => $club_id, 'post_id'=> $post->id])}}" class="dropdown-item text-warning">
                                                    <i class="ph-pencil me-2"></i>
                                                    Chỉnh sửa
                                                </a>
                                                <button type="button" wire:click="openDeleteModel({{ $post->id }})" class="dropdown-item text-danger">
                                                    <i class="ph-trash me-2"></i>
                                                    Xóa
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end align-items-center w-100 mt-3">
                        <div class="pagination">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
