<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Room;
use App\Events\MessageSent;
use Auth;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('chat');
    }
    public function fetchRoom()
    {
        return Room::all();
    }
    public function fetchMessages($id)
    {
        return Message::where('room_id',$id)->with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $message = $user->messages()->create([
            'message' => $request->input('message'),
            'room_id' => $request->input('roomchosen')
          ]);
        
        broadcast(new MessageSent($user, $message))->toOthers();
        return ['status' => 'Message Sent!'];
    }
}
