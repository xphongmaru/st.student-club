<?php

namespace App\Http\Controllers\Admin\Clubs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request){
        $club_id = $request->route('id');
        return view('admin.pages.clubs.member-index',[
            'club_id' => $club_id,
        ]);
    }

    public function detail(Request $request){
        $club_id = $request->route('id');
        $member_id = $request->route('member_id');
        return view('admin.pages.clubs.member-detail',[
            'club_id' => $club_id,
            'member_id' => $member_id,
        ]);
    }


}
