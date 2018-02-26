<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Memo;
use App\User;
use Auth;

class PageController extends Controller
{

    public function getCreatePage()
    {
        return view('admin.create');
    }

    public function getDashboardPage()
    {
        $user = Auth::user();
        $memo = Memo::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $memo_count = Memo::where('user_id', Auth::user()->id)->count();
        $like = $user->likes()->get();

        if(Auth::check()){
            return view('admin.dashboard', [ 
                'user' => $user, 
                'memos' => $memo, 
                'memo_count' => $memo_count, 
                'like' => $like 
            ]);
        }
    }

    public function getLoginPage()
    {
    	if(Auth::check()) {
    		return redirect()->route('dashboard');
    	}

    	return view('auth.login');
    }

    public function getSignupPage()
    {
    	if(Auth::check()) {
    		return redirect()->route('dashboard');
    	}

    	return view('home');
    }

    public function getFavouritesPage()
    {
        $user = Auth::user();
        $memos = Memo::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $memo_count = Memo::count();
        $like = $user->likes()->get();
        $liked_posts = [];

        foreach ($memos as $memo) {
            if($memo->likes()->first()) {
                if($memo->likes()->first()->is_like) {
                    $liked_posts[] = $memo;
                }
            }
        }

        if(Auth::check()){
            return view('admin.favourites', [ 
                'user' => $user, 
                'memo_count' => $memo_count, 
                'like' => $like,
                'liked_posts' => $liked_posts
            ]);
        }
    }

}
