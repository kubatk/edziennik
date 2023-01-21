<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        switch(\auth()->user()->group){
            case 'S':
                return view('student.home')->with('usergroup', "Uczeń");
                break;
            case 'T':
                return view('teacher.home')->with('usergroup', "Nauczyciel");
                break;
            case 'H':
                return view('headmaster.home')->with('usergroup', "Dyrektor");
                break;
            case 'P':
                return view('parent.home')->with('usergroup', "Rodzic");
        }

        return view('home')->with('usergroup');
    }

    public function timetable()
    {

        switch (\auth()->user()->group) {
            case 'S':
                return view('student.timetable');
                break;
            case 'T':
                return view('teacher.timetable');
                break;
            case 'P':
                return view('parent.timetable');
                break;
        }
        return view('home');

    }

    public function messages(){
        return view('messages')->with('usergroup', \auth()->user()->group);
    }

    public function read_message($id){
        $message = DB::table('messages')
            ->select('messages.*', 'user_data.first_name', 'user_data.last_name', 'receivers.read', 'receivers.id as receive_id')
            ->join('receivers', 'messages.id', '=', 'receivers.message')
            ->join('user_data', 'user_data.id', '=', 'messages.sender')
            ->where('receivers.user', \auth()->user()->user)
            ->where('messages.id', $id)
            ->get();
        if(count($message)==1){
            if(!$message[0]->read)
                DB::table('receivers')->where('id', $message[0]->receive_id)->update(['read'=>1]);
            return view('messages')->with('usergroup', \auth()->user()->group)->with('read_message', $message[0]);
        }
        else
            return redirect()->route('home');
    }

    public function new_message(Request $request){
        if($request->input('reply')){
            $message = DB::table('messages')
                ->select('messages.*', 'user_data.first_name', 'user_data.last_name')
                ->join('receivers', 'receivers.message', '=', 'messages.id')
                ->join('user_data', 'user_data.id', '=', 'messages.sender')
                ->where('receivers.user', \auth()->user()->user)
                ->where('messages.id', $request->input('reply'))
                ->get();

            if(count($message)==1)
                return view('new_message')->with('usergroup', \auth()->user()->group)->with('reply', $message[0]);
            else
                return redirect()->route('home');
        }

        return view('new_message')->with('usergroup', \auth()->user()->group);
    }

    public function addNewMessage(Request $request){
        $message = [
            'sender'=>\auth()->user()->user,
            'title'=>$request->input('title'),
            'content'=>$request->input('content'),
            'created_at'=> Carbon::now(),
        ];

        $message_id = DB::table('messages')->insertGetId($message);

        $receivers = explode(',', $request->input('receivers-id'));
        foreach ($receivers as $receiver){
            $data = [
                'message'=>$message_id,
                'user'=>$receiver,
            ];
            DB::table('receivers')->insert($data);
        }

        return redirect()->route('messages');
    }
}
