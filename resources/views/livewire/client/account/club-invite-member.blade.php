<div>
    <div class="card-body">
        <div class="title">
            <span class="ps-3"> Danh sách mời bạn tham gia từ các câu lạc bộ </span>
        </div>
        <div class="table-responsive">
            @if($invites->isEmpty())
                <div class="text-center">
                    <img src="{{ asset('assets/admin/images/empty.png') }}" alt="Không tìm thấy kết quả" style="width: 400px;" />
                </div>
            @else
                <table class="table-content d-block">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 1%">STT</th>
                        <th class="text-center" style="width: 30%">Tên CLB</th>
                        <th class="text-center" style="width: 30%">Chủ tịch</th>
                        <th class="text-center" style="width: 34%">Lời nhắn</th>
                        <th class="text-center" style="width: 5%; text-align: center">Hành động</th>
                    </thead>
                    <tbody>
                    @foreach($invites as $invite)
                        <tr class="text-center">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$invite->name}}</td>
                        <td>{{$invite->getUser($invite->owner_id)->full_name}}</td>
                        <td>{{$invite->pivot->message}}</td>
                        <td>
                            <div class="dropdown text-center ">
                                <a class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='fa fa-reorder'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('client.page-club',['id'=>$invite->id])}}">Xem CLB</a></li>
                                    @if($invite->pivot->status == \App\Enums\StatusRequestClub::Pending->value)
                                        <li><button class="dropdown-item" wire:click="ApprovedInvite({{$invite->id}})">Đồng ý tham gia</button></li>
                                        <li><button class="dropdown-item" wire:click="RejectedInvite({{$invite->id}})">Từ chối</button></li>
                                    @elseif($invite->pivot->status == \App\Enums\StatusRequestClub::Approved->value)
                                        <li ><span class="dropdown-item text-success">Bạn đã đồng ý tham gia CLB</span></li>
                                    @elseif($invite->pivot->status == \App\Enums\StatusRequestClub::Rejected->value)
                                        <li ><span class="dropdown-item text-danger">Bạn đã từ chối tham gia CLB</span></li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
</div>
