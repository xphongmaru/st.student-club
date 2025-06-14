<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotiCationController extends Controller
{
    public function notificationDetail(Request $request){
        $notification = Notification::query()->where('id', $request->notification_id)
            ->firstOrFail();
        return view('client.pages.notification-detail', [
            'notification' => $notification,
        ]);
    }
}
