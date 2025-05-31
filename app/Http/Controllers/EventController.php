<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request){
        return view('admin.pages.clubs.events.index', [
            'club_id' => $request->id,
        ]);
    }

    public function create(Request $request){
        return view('admin.pages.clubs.events.create', [
            'club_id' => $request->id,
        ]);
    }

    public function edit(Request $request){
        return view('admin.pages.clubs.events.edit', [
            'club_id' => $request->id,
            'event_id' => $request->event_id,
        ]);
    }

    public function detail(Request $request){
        return view('admin.pages.clubs.events.detail', [
            'club_id' => $request->id,
            'event_id' => $request->event_id,
        ]);
    }
}
