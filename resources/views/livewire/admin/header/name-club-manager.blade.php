<div>
    <a href="{{route('client.page-club', ['id'=>$club->id])}}" class="navbar-nav-link rounded-pill d-flex align-items-center">
        <img src="{{ asset('storage/'.$club->thumbnail) }}" class="w-32px h-32px rounded-pill me-2" alt="">
        <span>{{$club->name}}</span>
    </a>
</div>
