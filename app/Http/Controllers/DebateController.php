<?php
  
namespace App\Http\Controllers;
  
use Auth;
use App\User;
use App\Debate;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
  
class DebateController extends Controller
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
     * Display a form to start debate.
     */
    public function start()
    {

        return view('debate.start');
        
    }

    /**
     * Display a form to join debate.
     */
    public function join()
    {

        return view('debate.join');
        
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Display a form to start debate.
     */
    public function gostart(Request $request)
    {
        $debate = Debate::create([
            'topic' => $request['topic'],
            'type' => $request['debatetype'] != NULL ? $request['debatetype'] : '0',
            'adminkey' => $this->generateRandomString(10),
            'password' => $request['password'] != NULL ? $request['password'] : '',
            'rule' => $request['rule'] != NULL ? $request['rule'] : '',
            'debator' => Auth::user()->id,
            'moderator_one' => $request['moderator_one'] != NULL ? $request['moderator_one'] : '',
            'moderator_two' => $request['moderator_two'] != NULL ? $request['moderator_two'] : ''
        ]);

        $debate->save();

        return view('debate.starting')
               ->with('roomId', $debate->id)
               ->with('topic', $debate->topic)
               ->with('adminkey', $debate->adminkey)
               ->with('password', $request['password'] != NULL ? $request['password'] : '');
    }

    /**
     * Show a debate
     */
    public function debate($id, $password = NULL)
    {
        if( $id == NULL || $id == '' )
            return view('debate.error')->with('error', 'Wrong Input...');
        
        $debate = Debate::where('id', $id)->first();

        if( $debate == NULL )
            return view('debate.error')->with('error', 'Cannot find debate...');

        if( $debate->password != $password )
            return view('debate.error')->with('error', 'Password does not match...');

        if( $debate->debator == Auth::user()->id )
            $usertype = 'debator';
        else if( $debate->moderator_one == Auth::user()->email )
            $usertype = 'moderator_one';
        else if( $debate->moderator_two == Auth::user()->email )
            $usertype = 'moderator_two';
        else
            $usertype = 'subscriber';

        return view('debate.show')
               ->with('debate', $debate)
               ->with('usertype', $usertype)
               ->with('roomId', $id)
               ->with('pin', $password);
    }

    /**
     * Return a username of a moderator in a debate
     */

    public function getUserName(Request $request)
    {
        if( $request['type'] == NULL || $request['roomId'] == NULL )
            return response()->json(['']);
        
        $debate = Debate::where('id', $request['roomId'])->first();
        
        if( $debate == NULL )
            return response()->json(['']);
        
        $email = ($request['type'] == 'one' ? $debate->moderator_one : $debate->moderator_two);

        if( $email == NULL )
            return response()->json(['']);
        
        $user = User::where('email', $email)->first();
        
        if( $user == NULL )
            return response()->json(['']);
        else
            return response()->json(['name' => $user->name]);
    }

    /**
     * Join/Watch a debate
     */
    public function goForJoin(Request $request)
    {
        if( $request['watchDebateId'] != NULL )
        {
            if( $request['watchPassword'] == NULL )
                return redirect('debate/'.$request['watchDebateId'] );
            else
                return redirect('debate/'.$request['watchDebateId'].'/'.$request['watchPassword'] );
        }
        else if( $request['joinDebateId'] != NULL )
        {
            $debate = Debate::where('id', $request['joinDebateId'])->first();
            if( $debate != NULL )
            {
                if( $debate->moderator_one != Auth::user()->email && $debate->moderator_two != Auth::user()->email )
                {
                    if( $debate->moderator_one == NULL )
                    {
                        $debate->moderator_one = Auth::user()->email;
                        $debate->save();
                    }
                    else if( $debate->moderator_two == NULL )
                    {
                        $debate->moderator_two = Auth::user()->email;
                        $debate->save();
                    }
                    else
                        return view('debate.error')->with('error', 'Full of moderators...');
                }
                
                if( $request['joinPassword'] == NULL )
                    return redirect('debate/'.$request['joinDebateId'] );
                else
                    return redirect('debate/'.$request['joinDebateId'].'/'.$request['joinPassword'] );
            }
            else
                return view('debate.error')->with('error', 'No such debate...');
        }
        else
            return redirect('join');
    }
}