<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Debate;
use App\Invites;
use Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('home');

        $invite = Invites::where('email', Auth::user()->email )->first();
        if( $invite != NULL )
        {
            $debate = Debate::where('id', $invite->debateid)->first();
            if( $debate != NULL )
                return view('debate.invitejoin')->with('roomId', $invite->debateid)->with('password', $debate->password);
        }
        
        return redirect()->route('start');
    }
}
