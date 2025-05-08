<?php

namespace App\Http\Controllers\Admin\Clubs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestClubController extends Controller
{
    public function requestClub()
    {
        return view('admin.pages.clubs.request-club');
    }

    public function detail(int $id)
    {
        return view('admin.pages.clubs.request-club-detail',
        [
                'id' => $id,
        ]
        );
    }


}
