<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Session;
use App\User;
use App\Memo;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function signupUser(Request $request)
    {

    	$this->validate($request, [
			'username' => 'required|max:20|min:3|unique:users',
			'password' => 'required|max:30|min:5'
    	]);

    	$rememberMe = $request['remember'];

		$user = new User();
		$user->username = $request['username'];    	
		$user->password = bcrypt($request['password']); 
		$user->save();

		Auth::login($user, $rememberMe);  

		return redirect()->route('dashboard');

    }

    public function loginUser(Request $request)
    {

    	$rememberMe = $request['remember'];

		if(Auth::attempt([ 'username' => $request['username'], 'password' => $request['password'] ], $rememberMe)) {
			return redirect()->route('dashboard');
		}

		Session::flash('error-message', 'Invalid credentials or not existing user... <a href=' . route("signup-page") . '>did you already have an account?</a>');

		return redirect()->route('login-page');

    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('login-page');
    }

    public function uploadPic(Request $request)
    {
        if($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->save( public_path() .'/img/avatars/' . $filename );

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        return redirect()->route('dashboard');
    }

}
