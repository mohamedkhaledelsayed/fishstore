<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Notification;

class NotificationController extends Controller
{

    public function create(){
        return view('dashboard.notification.index');
    }
    public function store(Request $request){
        $request->validate([
            'title'=>'required',
            'body'=>'required|min:2|max:120'
        ]);

        Notification::create([
            'title'=>$request->title,
            'body'=>$request->body
        ]);


        sendNotification($request->title, $request->body);

        return redirect()->route('notification.index')->with('success',__('admin.notifications'));


    }
   
}
