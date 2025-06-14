<?php

namespace App\Http\Controllers\Admin\Clubs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request){
        return view('admin.pages.clubs.notifications.index', [
            'club_id' => $request->id,
        ]);
    }

    public function create(Request $request){
        return view('admin.pages.clubs.notifications.create', [
            'club_id' => $request->id,
        ]);
    }

    public function edit(Request $request){
        return view('admin.pages.clubs.notifications.edit', [
            'club_id' => $request->id,
            'notification_id' => $request->notification_id,
        ]);
    }

    public function detail(Request $request){
        return view('admin.pages.clubs.notifications.detail', [
            'club_id' => $request->id,
            'notification_id' => $request->notification_id,
        ]);
    }
}
