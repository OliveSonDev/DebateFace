<?php
  
namespace App\Http\Controllers;

use Mail;
use Auth;
use App\User;
use App\Debate;
use App\Comments;
use App\Invites;
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

        $one_timelimit = (int)$debate->one_timelimit == 0 ? 'unlimited' : ((int)time() < $debate->one_timelimit ? $debate->one_timelimit - (int)time(): 0);
        $two_timelimit = (int)$debate->two_timelimit == 0 ? 'unlimited' : ((int)time() < $debate->two_timelimit ? $debate->two_timelimit - (int)time() : 0);

        $feeling = [];
        $feeling['one_upvote'] = $debate->one_upvote ? count( explode(",", $debate->one_upvote) ) : 0;
        $feeling['one_downvote'] = $debate->one_downvote ? count( explode(",", $debate->one_downvote) ) : 0;
        $feeling['one_heart'] = $debate->one_heart ? count( explode(",", $debate->one_heart) ) : 0;
        $feeling['one_sharp'] = $debate->one_sharp ? count( explode(",", $debate->one_sharp) ) : 0;
        $feeling['two_upvote'] = $debate->two_upvote ? count( explode(",", $debate->two_upvote) ) : 0;
        $feeling['two_downvote'] = $debate->two_downvote ? count( explode(",", $debate->two_downvote) ) : 0;
        $feeling['two_heart'] = $debate->two_heart ? count( explode(",", $debate->two_heart) ) : 0;
        $feeling['two_sharp'] = $debate->two_sharp ? count( explode(",", $debate->two_sharp) ) : 0;

        $comments = Comments::where('debateid', $id)->get();

        return view('debate.show')
               ->with('topic', $debate->topic)
               ->with('usertype', $usertype)
               ->with('roomId', $id)
               ->with('pin', $password)
               ->with('feeling', $feeling)
               ->with('one_timelimit', $one_timelimit)
               ->with('two_timelimit', $two_timelimit)
               ->with('comments', $comments);
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
                return redirect('debate/'.$request['watchDebateId'].'/'.base64_encode( $request['watchPassword'] ) );
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
                $debate->one_timelimit = (int)time() + $request['limit'] ;
            else if( $request['who'] == 'two' )
                $debate->two_timelimit = (int)time() + $request['limit'] ;
            $debate->save();

            return response()->json( 'success' );
        }    
        else
            return response()->json( 'fail' );
    }

    /**
     * Add a feeling for a debator in a debate
     */
    public function addFeeling(Request $request)
    {
        $debate = Debate::where('id', $request['roomId'])->first();
        if( $debate != NULL )
        {
            if( $request['type'] == 'one_upvote' )
                $debate->one_upvote ++;
            else if( $request['type'] == 'one_downvote' )
                $debate->one_downvote ++;
            else if( $request['type'] == 'one_heart' )
                $debate->one_heart ++;
            else if( $request['type'] == 'one_sharp' )
                $debate->one_sharp ++;
            else if( $request['type'] == 'two_upvote' )
                $debate->two_upvote ++;
            else if( $request['type'] == 'two_downvote' )
                $debate->two_downvote ++;
            else if( $request['type'] == 'two_heart' )
                $debate->two_heart ++;
            else if( $request['type'] == 'two_sharp' )
                $debate->two_sharp ++;

            $debate->save();

            return response()->json( 'success' );
        }    
        else
            return response()->json( 'fail' );
    }

    /**
     * Add a feeling for a debator in a debate
     */
    public function addComment(Request $request)
    {
        $comment = Comments::create([
            'username' => Auth::user()->name,
            'debateid' => $request['roomId'],
            'text' => $request['text']
        ]);

        $comment->save();
        
        return response()->json( Auth::user()->name );
    }

    /**
     * Send Invite for a debator in a debate
     */
    public function sendInvite(Request $request)
    {
        $debate = Debate::where('id', $request['roomId'])->first();
        if( $debate != NULL )
        {
            if( $request['who'] == 'debator_one' )
            {
                $debate->debator_one = $request['email'];
                $debate->one_timelimit = 0;
            }
            else if( $request['who'] == 'debator_two' )
            {
                $debate->debator_two = $request['email'];
                $debate->one_timelimit = 0;
            }
            $debate->save();

            // Create new invite
            $invite = Invites::create([
                'debateid' => $request['roomId'],
                'email' => $request['email']
            ]);

            // Mail::send('emails.invitation', ['debateid' => $debate->id, 'topic' => $debate->topic], function ($m) use ($invite) {

            //     $m->to($invite->email)->subject('You got an invitation!');
            // });
    
            $invite->save();

            return response()->json( 'success' );
        }    
        else
            return response()->json( 'fail' );
    }

    /**
     * Check Invite for a debator in a debate and delete it
     */
    public function checkInvite(Request $request)
    {
        $invite = Invites::where('email', Auth::user()->email)->where('debateid', $request['roomId'])->first();
        if( $invite != NULL )
        {
            $invite->delete();
            return response()->json( 'success' );
        }    
        else
            return response()->json( 'fail' );
    }
}