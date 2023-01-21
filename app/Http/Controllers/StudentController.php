<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
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

    public function show_attendance($day = null){
        if($day == null)
            $day = date("Y-m-d", strtotime("last Monday"));

        return view('student.attendance')->with(['day'=>$day]);

    }

}
