<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Room;
use App\Models\Produksi;
use App\Models\User;
use App\Models\Sampling;
use App\Events\MessageSent;
use Auth;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web,admin');
    }
    public function index()
    {
        if(Auth::guard('admin')->check()){
            return view('chatadmin');
        }else{
            return view('chat');
        }
        
        //return Auth::guard('admin','web')->check();
    }
    public function fetchRoom()
    {
        return Room::with('sampling.detp')->with('produksi.detp')->get();
    }
    public function fetchMessages($id)
    {
        return Message::where('room_id',$id)->with('user')->with('admin')->get();
    }
    public function fetchjasa($id)
    {
        $user=User::find($id);
        $produksi=$user->produksis()->get();
        $sampling=$user->samplings()->get();
        return compact('produksi','sampling');
    }
    public function createRoom($user_id,$jenis,$tipejasa,$jasa_id)
    {
        
        if($jenis!=2){
            if($tipejasa==0){
                $room= new Room([
                    'jenis' => $jenis,
                    'user_id' => $user_id,
                    'prod_id' => $jasa_id,
                    
                ]);
                
            }elseif ($tipejasa==1) {
                $room= new Room([
                    'jenis' => $jenis,
                    'user_id' => $user_id,
                    'samp_id' => $jasa_id,
                    
                ]);
                
            }
        }elseif ($jenis==2) {
            $room= new Room([
                'jenis' => $jenis,
                'user_id' => $user_id,
                
            ]);
            
        }
        $room->save();
        //return compact('user_id','jenis','tipejasa','jasa_id');
        //return $room;
        return ['status' => 'room created!'];
    }

    public function sendMessage(Request $request)
    {
        $type = '';
        if(Auth::guard('admin')->check()){
            $user = null;
            $admin = Auth::guard('admin')->user();
            $message = $admin->messages()->create([
                'message' => $request->input('message'),
                'room_id' => $request->input('roomchosen')
              ]);
              broadcast(new MessageSent($admin, $user, $message))->toOthers();
        }else{
            $admin = null;
            $user = Auth::user();
            $message = $user->messages()->create([
                'message' => $request->input('message'),
                'room_id' => $request->input('roomchosen')
              ]);
              broadcast(new MessageSent($admin, $user, $message))->toOthers();
        }
        
        
        
        return ['status' => 'Message Sent!'];
    }
}
