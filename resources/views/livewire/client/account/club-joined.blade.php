<div>
    <div class="card-body">
        <div class="title">
            <span class="ps-3"> Danh sách CLB bạn đang tham gia </span>
        </div>
        <div>
            <table class="table-content">
                <thead>
                <tr>
                    <th class="text-center" style="width: 1%">STT</th>
                    <th class="text-center" style="width: 30%">Tên CLB</th>
                    <th class="text-center" style="width: 30%">Chủ tịch</th>
                    <th class="text-center" style="width: 34%">Lĩnh vực hoạt động</th>
                    <th class="text-center" style="width: 5%; text-align: center">Hành động</th>
                </thead>
                <tbody>
                @foreach($clubs as $club)
                <tr class="text-center">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$club->name}}</td>
                    <td>{{$club->getUser($club->owner_id)->full_name}}</td>
                    <td>{{$club->field_of_activity}}</td>
                    <td>
                        <div class="dropdown text-center ">
                            <a class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='fa fa-reorder'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('client.page-club',['id'=>$club->id])}}">Xem CLB</a></li>
                                <li><button class="dropdown-item" wire:click="LeftClubs({{$club->id}})" >Rời khỏi CLB</button></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
