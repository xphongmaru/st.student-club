<?php

namespace App\Http\Controllers\Client\Club;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Post;
use Illuminate\Http\Request;

class ClientPostController extends Controller
{
    public function PostIndex(Request $request)
    {
        $club = Club::query()->where('id', $request->route('id'))->first();
        return view('client.pages.club-post-index',[
            'club' => $club,
        ]);
    }

    public function PostDetail(request $request){
        $club = Club::query()->where('id', $request->route('id'))->first();
        $post = Post::query()->where('club_id', $club->id)->where('slug', $request->route('slug'))->first();
        return view('client.pages.club-post-detail',[
            'post' => $post,
            'club' => $club,
        ]);
    }

    public function index()
    {
        return view('client.pages.post-index');
    }

    public function detail(){

    }
}
