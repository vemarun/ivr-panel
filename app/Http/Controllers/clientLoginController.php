<?php

namespace App\Http\Controllers;

use App\clientDetail;
use App\clientLogin;
use App\clientManageSources;
use App\Jobs\PasswordChangedReminder;
use App\logs;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Response;
use Session;
use Yajra\Datatables\Datatables;

class clientLoginController extends Controller
{

    /***********************
     *   Client Login Logic
     ******************/
    public function login(Request $request, logs $logs, clientManageSources $source)
    {
        if (!Auth::check()) {
            /*** validate client login form ***/
            $this->validate(request(), [
                'username' => 'required',
                'password' => 'required',
            ]);

            /** fetch login form username /password **/
            $username = $request->input('username');
            $password = $request->input('password');

            /** attempt to login by matching username , password , (tablename defined in config->auth.php)**/

            if (!auth()->attempt(['username' => $username, 'password' => $password, 'is_active' => 1])) {
                $message = 'Incorrect Login Details';

                /**log entry **/
                $logs->newlog('Attempted login : ' . $message);
                /** log entry **/

                return back()->withErrors([
                    'message' => $message,
                ]);
            }
        }

        /*get user's current ip/browser and update in db */
        clientLogin::where('id', Auth::user()->id)->update(['ip_address' => \Request::ip(), 'user_agent' => $request->header('User-Agent')]);
        $logs->newlog('Successfully Logged in from browser ' . Auth::user()->user_agent);

        /* show welcome msg to user in dashboard*/
        session()->flash('msg', 'Welcome, ' . Auth::user()->username);

        if (Auth::user()->client_type == 'client') {
            $source_number = DB::table('client_manage_sources')->where('user_id', Auth::user()->id)->first();
            if (empty($source_number)) {
                $source_number = new \stdClass();
                $source_number->source_number = 'No source Number Found';
            }
            session()->put('source_number', $source_number->source_number);
            return redirect('/dashboard');
        } else if (Auth::user()->client_type == 'reseller') {
            return redirect('/resellerivr');
        } else if (Auth::user()->client_type == 'seller') {
            return redirect('/resellerivr');
        } else if (Auth::user()->client_type == 'admin') {
            return redirect('/admin');
        }

    }

/******************************************
 *    Log out
 *****************************************/

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect('/clientlogin');
    }

    #change password ->this will create a queue(job) also on password change
    public function changePassword(Request $request)
    {
        $logs = new logs;
        $id = Auth::user()->id;
        /*** validate password ***/
        $this->validate(request(), [
            'current_password' => 'required',
            'password' => 'confirmed|min:6',
        ]);

        $details = $request->all();

        if (empty($details['current_password']) || !array_key_exists('current_password', $details) || empty($details['password']) || !array_key_exists('password', $details)) {
            $message = "Error changing password ! Please recheck submitted data";

            /*log entry*/
            $logs->newlog($message);
            /** log entry **/

            return Response::json([
                'message' => $message], 422);
        }

        $password = DB::select("select password from client_logins where id='" . $id . "'");
        $hashed_password = $password[0]->password;

        #verify old password
        if (Hash::check($details['current_password'], $hashed_password)) {

            #if matches update to new password
            clientLogin::where('id', $id)->update(['password' => bcrypt($details['password'])]);
            $message = 'Password has been changed successfully.';

            /*log entry*/
            $logs->newlog($message);
            /** log entry **/

            /* send email to user regarding password change */
            $detail = new \stdClass();
            $detail->name = Auth::user()->username;
            $email = clientDetail::find($id)->email;
            $detail->email = $email;

            //dispatch this job into queue (this will send email regarding password change)
            dispatch(new PasswordChangedReminder($detail));

            return Response::json([
                'message' => $message], 201);
        } else {

            $message = "Wrong Password! Please recheck submitted data";

            /*log entry*/
            $logs->newlog($message);
            /** log entry **/

            return Response::json([
                'message' => $message], 422);
        }
    }

    #[admin]
    protected function admin_manageuser(clientLogin $data, Datatables $datatables)
    {
        if (Auth::user()->username != 'root') {
            return Response::json(['message' => "Unauthorized Not allowed"], 404);
        } else {
            return $datatables->collection($data->get())->make(true);
        }
    }

    public function admin_manageuser_index(clientLogin $data)
    {
        return view('admin.manageusers');
    }

    protected function ban($id)
    {
        if (Auth::user()->client_type != 'admin') {
            return Response::json(['message' => "Unauthorized Not allowed"], 404);
        }

        $user = new clientLogin;
        $msg = $user->ban_user($id);
        return Response::json(['message' => $msg], 201);
    }

    protected function revokeApiToken($id)
    {
        if (Auth::user()->username != 'root') {
            return Response::json(['message' => "Unauthorized Not allowed"], 404);
        }

        $user = new clientLogin;
        $msg = $user->revoke_token($id);
        return Response::json(['message' => $msg], 201);

    }

    public function api()
    {
        return view('clientivr.api');
    }

    public function changeSessionSourceNumber(Request $request, clientManageSources $sources)
    {
        $this->validate($request, [
            'session_source_number' => 'required',
        ]);

        $source_number = $sources->where('source_number', $request->session_source_number)
            ->where('user_id', Auth::user()->id)->exists();

        if (!$source_number) {
            return Response::json(['message' => 'Wrong source number'], 400);
        } else {
            session()->put('source_number', $request->session_source_number);
            return Response::json(['message' => 'Session Source number changed'], 200);
        }
    }
}
