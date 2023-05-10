<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Comments;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Storage;

class CommentsController extends Controller
{
    public function addComment(Request $request,$id)
    {
       
       $post=Post::with('user','comments')->get()->find($id);
       
       $comment=Comments::with('user')->where('post_id',$id)->get();

       $allComment=Comments::where('post_id',$id)->get();
       
       $i = 0;
       foreach ($allComment as $a) {
           $i++;
       }
       $count = $i;
    //    dd($count);
        
        return view('auth.onePost',compact('post','comment','count'));
    }


    public function commentAdd(Request $request,$id)
    {
        // dd($request->comments);
        $request->validate([
            
            'coment' => ['required'],

        ]);
        $user = Comments::create([
            'user_id' => Auth::user()->id,
            'post_id' =>$id,
            'coment' => $request->coment,
        ]);
        
        return redirect()->route('auth.userDashboard');            

        // dd($request->all());
    }

   
}
