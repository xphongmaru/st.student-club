<div>
    <div class="card-body">
        <div class="title">
            <span class="ps-3"> Danh sách đơn đăng ký CLB  </span>
        </div>
        <div class="table-responsive">
            @if($requestClubs->isEmpty())
                <div class="text-center">
                    <img src="{{ asset('assets/admin/images/empty.png') }}" alt="Không tìm thấy kết quả" style="width: 400px;" />
                </div>
            @else
                <table class="table-content">
                <thead>
                <tr>
                    <th class="text-center" style="width: 1%">STT</th>
                    <th class="text-center" style="width: 30%">Tên CLB</th>
                    <th class="text-center" style="width: 30%">Lĩnh vựa hoạt động</th>
                    <th class="text-center" style="width: 20%">Logo</th>
                    <th class="text-center" style="width: 34%">Trạng thái</th>
                    <th class="text-center" style="width: 1%; text-align: center">Hành động</th>
                </thead>
                <tbody>
                @foreach($requestClubs as $requestClub)
                <tr class="text-center">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$requestClub->name}}</td>
                    <td>{{$requestClub->field_of_activity}}</td>
                    <td><img src="{{asset('storage/'.$requestClub->thumbnail)}}" style="max-height: 80px; object-fit: cover" alt=""></td>
                    @php
                        $statusEnum = App\Enums\StatusRequestClub::mapValue($requestClub->status);
                    @endphp
                    <td>{{$statusEnum->label()}}</td>
                    <td>
                        <div class="dropdown text-center ">
                            <a class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='fa fa-reorder'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><button wire:click="CancelRequest({{$requestClub->id}})" class="dropdown-item" href="#">Hủy đơn</button></li>
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
