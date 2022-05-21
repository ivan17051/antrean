<?php namespace App\Http\Controllers;
use View;
use Input;
use Auth;
use Redirect;
use DB;
use Response;
use Validator;
use Illuminate\Http\Request;
use Session;
use Log;

class UserController extends Controller {
    
    public function index() {
        return View::make('login');
    }

    public function doLogin(Request $request){
    	$validator = Validator::make($request->all(), [
	        'idunitkerja' => 'required',
	        // 'username' => 'required',
            'password' => 'required'
	    ]);

	    if ($validator->fails()) {
            // return redirect('login')
            //             ->withErrors($validator)
            //             ->withInput();
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
        }

        $idunitkerja = Input::get('idunitkerja');
        $user = Input::get('username');
        $pass = Input::get('password');
        $credentials = [
            'idunitkerja' => $idunitkerja,
            // 'username' => $user,
            'password' => $pass,
            'isactive' => 1
        ];
        if (Auth::attempt($credentials)) {
            return redirect('/');
        } else {
            // Log::info('User failed to login.', $credentials);
            return Redirect::route('login')->with('error', 'Login Failed');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}