<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\Notifications;
use App\Models\Comments;

use Session;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('auth.userDashboard')->with('success','You are Logged in sucessfully.');            
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    
}

public function userDashboard(){

    Session::forget('setPost');
    $post=Post::with('user','comments','reaction')->get();
    if (isset($post) && !empty($post)) {
        $data=[];
    foreach ($post as $key => $datas) {
        $data=$datas;
        // dd($datas);
    }

    
    $posts=Post::with('user','comments','reaction')->where('user_id',auth()->user()->id)->get();
    // $a=0;$b=0;
    $disliked=[];
    $liked=[];
    $likes=[];
    $likedSum=[];
    foreach($posts as $data){
        // dd($opm);
        
        $liked[] = Notifications::with('user','post')->whereIn('post_id',[$data->id])->whereNotIn('user_id',[auth()->user()->id])->where('liked',1)->where('notification_status',0)->count();
        $likes = Notifications::with('user','post','reaction')->whereIn('post_id',[$data->id])->where('liked',1)->where('notification_status',0)->get();
        $disliked[] = Notifications::with('user','post')->whereIn('post_id',[$data->id])->where('dislike',1)->count();
    }
    if (isset($liked) && !empty($liked)) {
        // dd($liked);
       
        $likedSum =  array_sum($liked);
    }
    $dislikedSum = array_sum($disliked);
    
    
    // dd($likes);
    
    // $a=0;$b=0;

    $reaction = Reaction::with('user','post')->where('user_id',auth()->user()->id)->get();
    Session::put(['setPost'=>$likedSum,'likeds'=>$likes,'post'=>$data]);
    
    // dd($post['user']['0']['name']);
    // dd($data);

    }
    

    return view('auth.postView',compact('post','reaction'));
}
}
