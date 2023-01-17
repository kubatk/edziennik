<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
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


    public function show_attendance($class = 0, $day = null){
        if($day == null)
            $day = date("Y-m-d");

        if($class==0){
            $lesson = DB::table('lessons')
                ->where('lessons.lecturer', \auth()->user()->id)
                ->first();
            if($lesson)
                return view('teacher.attendance')->with(['class_id'=>$lesson->class, 'day'=>$day]);
        }
        else{
            $valid = DB::table('lessons')
                ->join('classes', 'lessons.class', '=', 'classes.id')
                ->where('lessons.lecturer', \auth()->user()->id)
                ->where('lessons.class', $class)
                ->count();
            if($valid)
                return view('teacher.attendance')->with(['class_id'=>$class, 'day'=>$day]);
        }
        return view('home');
    }

    public function saveAttendance(Request $request){
        $attendance = json_decode($request->input('attendance-json'), true);

        foreach($attendance as $a) {
            if ($a['operation'] == 'insert') {
                $new = [
                    'student' => $a['student'],
                    'timetable' => $a['lesson'],
                    'status' => $a['status'],
                    'date' => $request->input('day'),
                    'created_at' => Carbon::now(), # new \Datetime(),
                    'updated_at' => Carbon::now(), # new \Datetime(),
                ];
                DB::table('presence')->insert($new);
            } elseif ($a['operation'] == 'update') {
                $update = [
                    'status' => $a['status'],
                    'updated_at' => Carbon::now(),
                ];
                DB::table('presence')
                    ->where('student', $a['student'])
                    ->where('timetable', $a['lesson'])
                    ->where('date', $request->input('day'))
                    ->update($update);
            } elseif ($a['operation'] == 'delete') {
                DB::table('presence')
                    ->where('student', $a['student'])
                    ->where('timetable', $a['lesson'])
                    ->where('date', $request->input('day'))
                    ->delete();
            }
        }
        return redirect()->route('teacher_attendance_with_day', ['day'=>$request->input('day'), 'class'=>$request->input('class')]);
    }
}
