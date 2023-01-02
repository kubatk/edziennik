<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        switch(auth()->user()->group){
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
}
