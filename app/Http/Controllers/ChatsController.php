<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Room;
use App\Models\Produksi;
use App\Models\User;
use App\Models\Jasa;
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
    public function fetchRoom($id)
    {
        if(Auth::guard('admin')->check()){
           // return Room::with('jasa.detp')->with('messageslatest')->orderby('messageslatest.created_at','asc')->get(); 
            $room =Room::with('jasa.detp')->with('messageslatest')->get(); 
            $sorted = $room->sortByDesc('messageslatest.created_at')->sortByDesc('messageslatest.user_id');
            return $sorted->values()->all();
        }else{
            $room =Room::where('user_id',$id)->with('jasa.detp')->with('messageslatest')->get();
            $sorted = $room->sortByDesc('messageslatest.admin_id')->sortByDesc('messageslatest.created_at');
            return $sorted->values()->all();
        }
    }
    public function fetchMessages($id)
    {
        return Message::where('room_id',$id)->with('user')->with('admin')->get();
    }
    public function fetchjasa($id)
    {
        if(Auth::guard('admin')->check()){
            $produksi=Jasa::where([
                ['jenis_jasa','=', '1'],
            ])->with('detp')->get();
            $sampling=Jasa::where([
                ['jenis_jasa','=', '0'],
            ])->with('detp')->get();
        }else{
            $user=User::find($id);
            $produksi=Jasa::where([
                ['jenis_jasa','=', '1'],
                ['cus_id','=', $id],
            ])->with('detp')->get();
            $sampling=Jasa::where([
                ['jenis_jasa','=', '0'],
                ['cus_id','=', $id],
            ])->with('detp')->get();
        }
        return compact('produksi','sampling');
    }
    public function createRoom($jenis,$tipejasa,$jasa_id)
    {
        $user_id2=Auth::user()->id;
        $user_id=Jasa::where([
            ['id','=', $jasa_id],
        ])->value('cus_id');
        if($jenis!=2){
            if($tipejasa==0){
                $room= new Room([
                    'jenis' => $jenis,
                    'user_id' => $user_id,
                    'jasa_id' => $jasa_id,
                    
                ]);
                
            }elseif ($tipejasa==1) {
                $room= new Room([
                    'jenis' => $jenis,
                    'user_id' => $user_id,
                    'jasa_id' => $jasa_id,
                    
                ]);
                
            }
        }elseif ($jenis==2) {
            $room= new Room([
                'jenis' => $jenis,
                'user_id' => $user_id2,
                
            ]);
            
        }
        $room->save();
        //return compact('user_id','jenis','tipejasa','jasa_id');
        //return $room;
        return ['status' => 'room created!'];
    }
    public function delRoom($room_id)
    {
        Room::where('id', $room_id)->delete();
        return ['status' => 'room deleted!'];
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
