<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    //
    public function index(Request $request){
        $notifications = Notification::orderBy('created_at', 'desc')->paginate();
        $totalUnRead = Notification::where('status', 0)->count();
        return response()->json(['totalUnread' => $totalUnRead, 'datas' => $notifications]);
    }

    public function store(){

    }
}
