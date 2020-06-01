<?php
  
namespace App\Http\Controllers;
  
use Auth;
use Illuminate\Http\Request;
  
class StartController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('start.index');
        
    }
}