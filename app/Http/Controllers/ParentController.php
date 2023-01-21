<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ParentController extends Controller
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

        return view('parent.attendance')->with(['day'=>$day]);

    }

    public function correctAbsence(Request $request){
        $data = [
            'status'=>3,
            'updated_at' => Carbon::now(),
        ];
        $entries = explode(',', $request->input('id'));
        foreach ($entries as $e)
            DB::table('presence')->where('id', $e)->update($data);

        return view('parent.attendance')->with(['day'=>$request->input('day')]);
    }
}
