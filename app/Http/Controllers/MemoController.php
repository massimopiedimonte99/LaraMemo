<?php

namespace App\Http\Controllers;

use Auth;
use App\Memo;
use App\Like;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:30',
            'content' => 'required|max:4200'
        ]);
        
        $title = filter_var($request->title, FILTER_SANITIZE_STRING);
        $content = filter_var($request->content, FILTER_SANITIZE_STRING);

        $memo = new Memo();
        $memo->title = $title;
        $memo->content = $content;
        $memo->user_id = Auth::user()->id;
        $memo->save();

        return redirect()->route('memo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function show(Memo $memo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function edit(Memo $memo)
    {
        $memo = Memo::where('id', $memo->id)->first();
        
        if(Auth::check()) {
            if(Auth::user()->id != $memo->user->id) {
                return redirect()->route('dashboard');
            }
        } else {
            return redirect()->route('home');
        }
        
        return view('admin.edit')->with(['memo' => $memo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Memo $memo)
    {
        $this->validate($request, [
            'title' => 'required|max:30',
            'content' => 'required|max:4200'
        ]);

        $title = filter_var($request['title'], FILTER_SANITIZE_STRING);
        $content = filter_var($request['content'], FILTER_SANITIZE_STRING);

        $memo = Memo::where('id', $memo->id)->first();
        $memo->title = $request['title'];
        $memo->content = $request['content'];
        $memo->user_id = Auth::user()->id;
        $memo->save();

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Memo $memo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memo $memo)
    {
        $memo = Memo::where('id', $memo->id)->first();
        $like = $memo->likes()->first();
        
        $memo->delete();
        $like->delete();

        return redirect()->route('memo.index');
    }

    public function likeMemo(Request $request)
    {
        $memo_ID = $request['id'];
        $memo = Memo::findOrFail($memo_ID)->first();

        // Is already liked...?
        $like = Auth::user()->likes()->where('memo_id', $memo_ID)->first();

        // Insert data into DB.
        if(!$like) {
            $like = new Like();
            $like->user_id = Auth::user()->id;
            $like->memo_id = $memo_ID;
            $like->is_like = true;
            $like->save();    
            return response()->json(['status' => true]);
        } else {
            if($like->is_like) {
                $like->is_like = false;
                $like->update();
                return response()->json(['status' => false], 200);
            } else {
                $like->is_like = true;
                $like->update();
                return response()->json(['status' => true], 200);
            }  
        }

    }
}
