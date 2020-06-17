<?php

namespace App\Http\Controllers;

use App\Models\UserConnection;
use App\Models\User;
use App\Notifications\ConnectionRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
class UserConnectionsController extends Controller
{
    public function __construct(){
        // $this->middleware('auth:api');
    }
   public function connection(Request $request){
    $con = new UserConnection;
    $con->user_id = request('user_id');
    $con->connection_id = request('connection_id');
    $check = UserConnection::where('user_id', $request->user_id)->where('connection_id', $request->connection_id)->first();
    if(!empty($check)){
        if($check->blocked == 1){
            return 403;
        }elseif($check->is_accepted == 0){
            return 400;
        }else{
            return 300;
        }
    }else{

     $con->save();
     // Sending Notification
        $to = User::where('id', $request->connection_id);
        $fromUser = User::where('id', $request->user_id);
        $fromUser['notification_type'] = 'Connection';
        $to->notify(new ConnectionRequestNotification($fromUser));
        return 200;
    }


   }



   public function accept_connection(Request $request){

    $conn = UserConnection::where('user_id', $request->from)->where('connection_id', $request->to)->first();

     // dd($conn);
    $conn->is_accepted = 1;
    $conn->save();

    return 200;
   }
   public function block_connection(Request $request){

    $conn = UserConnection::where('user_id', $request->from)->where('connection_id', $request->to)->first();

     // dd($conn);
    $conn->blocked = 1;
    $conn->is_accepted = 0;
    $conn->save();

    return 200;
   }


}
