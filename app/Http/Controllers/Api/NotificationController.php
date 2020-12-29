<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notification;
class NotificationController extends Controller
{
   public  function index(){
       $notificationlist =Notification::orderBy('id', 'DESC')->paginate();

       return response()->json(['status'=>true,'data'=>$notificationlist]);
   }
}
