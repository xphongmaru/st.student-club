<?php

namespace App\Http\Controllers\Admin\Clubs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecruitmentMemberController extends Controller
{
    public function index(Request $request){
        $club_id = $request->id;
        return view('admin.pages.clubs.recruitment_members.recruitment-index',[
            'club_id'=> $club_id,
        ]);
    }

    public function create(Request $request){
        $club_id = $request->id;
        return view('admin.pages.clubs.recruitment_members.recruitment-create',[
            'club_id'=> $club_id,
        ]);
    }

    public function detail(Request $request){
        $club_id = $request->id;
        $recruitment_id = $request->recruitment_id;
        return view('admin.pages.clubs.recruitment_members.recruitment-detail',[
            'club_id'=> $club_id,
            'recruitment_id'=> $recruitment_id,
        ]);
    }

    public function listRequest(Request $request)
    {
        $club_id = $request->id;
        $recruitment_id = $request->recruitment_id;
        return view('admin.pages.clubs.recruitment_members.requests.index',[
            'club_id'=> $club_id,
            'recruitment_id'=> $recruitment_id,
        ]);

    }

    public function detailRequest()
    {
        $club_id = request()->id;
        $recruitment_id = request()->recruitment_id;
        $request_id = request()->request_id;
        return view('admin.pages.clubs.recruitment_members.requests.detail',[
            'club_id'=> $club_id,
            'recruitment_id'=> $recruitment_id,
            'request_id'=> $request_id,
        ]);

    }

}
