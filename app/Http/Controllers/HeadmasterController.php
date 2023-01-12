<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HeadmasterController extends Controller
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

    public function addUser(Request $request){
        function random_string($length_of_string){
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            return substr(str_shuffle($str_result), 0, $length_of_string);
        }
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $address = $request->input('address');
        $group = $request->input('group');
        if($group=='S')
            $class = $request->input('class');
        else
            $class = NULL;

        $code = random_string(6);

        $data = array(
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'address'=>$address,
            'group'=>$group,
            'class'=>$class,
            'account_code'=>$code,
        );

        DB::table('user_data')->insert($data);

        return redirect()->route('manage_users');
    }

    public function addClass(Request $request){
        $data = array(
            'name' => $request->name,
            'school_year' => $request->school_year,
        );

        DB::table('classes')->insert($data);
        return redirect()->route('home');
    }

    public function viewTimetable($classId){
        $class = DB::table('classes')->where('id', $classId)->first();
        if($class)
            return view('headmaster.timetable')->with('class', $class);
        else
            return redirect()->route('home');
    }

    public function addLesson(Request $request){
        $data = [
            'name' => $request->input('name'),
            'school_year' => $request->input('school_year'),
            'lecturer' => $request->input('teacher'),
            'class' => $request->input('class'),
        ];

        DB::table('lessons')->insert($data);
        return redirect()->route('headmaster_timetable', $request->class);
    }


    public function addToTimetable(Request $request){
        $class = DB::table('classes')->where('id', $request->input('class'))->first();
        $lesson = DB::table('lessons')->where('id', $request->input('lesson'))->first();
        $data = [
            'lesson'=>$request->input('lesson'),
            'day'=>$request->input('day'),
            'start'=>$request->input('start_hour'),
            'duration'=>45,
        ];

        DB::table('timetable')->insert($data);
        return redirect()->route('headmaster_timetable', $request->input('class'));
    }

    public function removeFromTimetable(Request $request){

        $count = DB::table('timetable')->where('id', $request->input('id'))->count();

        if($count>0){
            DB::table('timetable')->where('id', $request->input('id'))->delete();
        }

        return redirect()->route('headmaster_timetable', $request->input('class'));
    }

}
