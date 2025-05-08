<?php

namespace App\Http\Controllers\Admin\Clubs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;

class ClubController extends Controller
{
    public function index()
    {
        return view('admin.pages.clubs.index');
    }

    public function detail(int $id)
    {
        return view('admin.pages.clubs.club-detail',
        [
                'id' => $id,
        ]
        );
    }

    public function listClub(){
        return view('admin.pages.clubs.list-clubs');
    }
}
