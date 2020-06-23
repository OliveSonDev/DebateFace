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
            'moderator' => Auth::user()->id,
            'debator_one' => $request['debator_one'] != NULL ? $request['debator_one'] : '',
            'debator_two' => $request['debator_two'] != NULL ? $request['debator_two'] : ''
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
    public function debate($id, $pass = NULL)
    {
        if( $id == NULL || $id == '' )
            return view('debate.error')->with('error', 'Wrong Input...');

        $password = $pass == NULL ? NULL : base64_decode($pass);
        
        $debate = Debate::where('id', $id)->first();

        if( $debate == NULL )
            return view('debate.error')->with('error', 'Cannot find debate...');

        if( $debate->type == 1 && $debate->password != $password )
            return view('debate.error')->with('error', 'Password does not match...');

        if( $debate->moderator == Auth::user()->id )
            $usertype = 'moderator';
        else if( $debate->debator_one == Auth::user()->email )
            $usertype = 'debator_one';
        else if( $debate->debator_two == Auth::user()->email )
            $usertype = 'debator_two';
        else
            $usertype = 'subscriber';

        return view('debate.show')
               ->with('debate', $debate)
               ->with('usertype', $usertype)
               ->with('roomId', $id)
               ->with('pin', $password);
    }

    /**
     * Return a username of a debator in a debate
     */

    public function getUserName(Request $request)
    {
        if( $request['type'] == NULL || $request['roomId'] == NULL )
            return response()->json(['']);
        
        $debate = Debate::where('id', $request['roomId'])->first();
        
        if( $debate == NULL )
            return response()->json(['']);
        
        $email = ($request['type'] == 'one' ? $debate->debator_one : $debate->debator_two);

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
                return redirect('debate/'.$request['watchDebateId'].'/'.base64_encode( $request['joinPassword'] ) );
        }
        else if( $request['joinDebateId'] != NULL )
        {
            $debate = Debate::where('id', $request['joinDebateId'])->first();
            if( $debate != NULL )
            {
                if( $debate->password == $request['joinPassword'] && $debate->debator_one != Auth::user()->email && $debate->debator_two != Auth::user()->email )
                {
                    if( $debate->debator_one == NULL )
                    {
                        $debate->debator_one = Auth::user()->email;
                        $debate->save();
                    }
                    else if( $debate->debator_two == NULL )
                    {
                        $debate->debator_two = Auth::user()->email;
                        $debate->save();
                    }
                    else
                        return view('debate.error')->with('error', 'Full of debators...');
                }
                
                if( $request['joinPassword'] == NULL )
                    return redirect('debate/'.$request['joinDebateId'] );
                else
                    return redirect('debate/'.$request['joinDebateId'].'/'.base64_encode( $request['joinPassword'] ) );
            }
            else
                return view('debate.error')->with('error', 'No such debate...');
        }
        else
            return redirect('join');
    }

    /**
     * Get Admin Key
     */
    public function getAdminKey(Request $request)
    {
        $debate = Debate::where('id', $request['roomId'])->first();
        if( $debate != NULL && $debate->moderator == Auth::user()->id )
            return response()->json( $debate->adminkey );
        else
            return response()->json( '' );
    }

    /**
     * Attach 'kicked' text to email of debator in a debate
     */
    public function kickDebator(Request $request)
    {
        $debate = Debate::where('id', $request['roomId'])->first();
        if( $debate != NULL && $debate->moderator == Auth::user()->id )
        {
            if( $request['who'] == 'one' )
                $debate->debator_one = $debate->debator_one.'kicked';
            else if( $request['who'] == 'two' )
                $debate->debator_one = $debate->debator_one.'kicked';
            $debate->save();

            return response()->json( 'success' );
        }    
        else
            return response()->json( 'fail' );
    }

    /**
     * Save Timelimit value to debator
     */
    public function saveTimer(Request $request)
    {
        $debate = Debate::where('id', $request['roomId'])->first();
        if( $debate != NULL && $debate->moderator == Auth::user()->id )
        {
            if( $request['who'] == 'one' )
                $debate->one_timelimit = $request['limit'] * 1000;
            else if( $request['who'] == 'two' )
                $debate->two_timelimit = $request['limit'] * 1000;
            $debate->save();

            return response()->json( 'success' );
        }    
        else
            return response()->json( 'fail' );
    }
}