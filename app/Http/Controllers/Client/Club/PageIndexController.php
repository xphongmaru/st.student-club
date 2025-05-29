<?php

namespace App\Http\Controllers\Client\Club;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;

class PageIndexController extends Controller
{
    public function index($id){
        $club = Club::query()
            ->where('id', $id)
            ->first();
        return  view('client.pages.page-club',
        [
            'club' => $club,
        ]);
    }

    public function listClub()
    {
        return  view('client.pages.list-club');
    }
}
