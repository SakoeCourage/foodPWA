<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return([
            'unreadnotifications' => request()->user()->unreadNotifications->count()
        ]);
    }

    public function getUserNotifications(){
        return( [
            'notifications' => request()->user()->Notifications()->paginate(10)
         ]);
    }

    public function marknotificationsasread(){

        return([
            'notificationsread' => request()->user()->unreadNotifications->markAsRead()
        ]);

}

}
