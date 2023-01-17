<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function show_marks($lesson = 0){
        if($lesson==0){
            $valid = DB::table('lessons')->where('lecturer', \auth()->user()->id)->count();
            if($valid>0){
                $lesson = DB::table('lessons')->where('lecturer', \auth()->user()->id)->first();
                return view('teacher.marks')->with('lesson_id', $lesson->id);
            }
        }
        else{
            $valid = DB::table('lessons')->where('lecturer', \auth()->user()->id)->where('id', $lesson)->count();
            if($valid==1)
                return view('teacher.marks')->with('lesson_id', $lesson);
        }
        return view('home');
    }

    public function addMarkCategory(Request $request){
        $data = [
            'name'=>$request->input('name'),
            'lesson'=>$request->input('lesson'),
            'count_to_avg'=>$request->input('average')=='on',
            'weight'=>$request->input('weight'),
        ];

        DB::table('categories')->insert($data);
        return redirect()->route('teacher_marks_with_class', [$request->input('lesson')]);
    }

    public function saveMarks(Request $request){
        $marks = json_decode($request->input('marks-json'), true);

        foreach($marks as $mark){
            if($mark['operation'] == 'insert'){
                $new = [
                    'student'=>$mark['student'],
                    'category'=>$mark['category'],
                    'mark'=>$mark['mark'],
                    'created_at'=>Carbon::now(), # new \Datetime(),
                    'updated_at'=>Carbon::now(), # new \Datetime(),
                ];
                DB::table('grade')->insert($new);
            }
            elseif ($mark['operation'] == 'update'){
                $update = [
                    'mark'=>$mark['mark'],
                    'updated_at'=>Carbon::now(),
                ];
                DB::table('grade')
                    ->where('student', $mark['student'])
                    ->where('category', $mark['category'])
                    ->update($update);
            }
            elseif ($mark['operation'] == 'delete'){
                DB::table('grade')
                    ->where('student', $mark['student'])
                    ->where('category', $mark['category'])
                    ->delete();
            }
        }

        return redirect()->route('teacher_marks_with_class', [$request->input('lesson')]);
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
