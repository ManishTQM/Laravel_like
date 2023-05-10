<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Storage;

class PostController extends Controller
{
    public function postView(Request $request)
    {
        $user=Auth::user()->id ;
       
        // dd($user);
        return view('auth.post',compact('user'));
    }

    public function postAdd(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'post_title' => ['required', 'string', 'max:255'],
            'description' => ['required'],

        ]);
        
        if ($request->hasfile('image')) {
                $file = $request->file('image');
                $name = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            //    dd($name);
                $filename = pathinfo($name, PATHINFO_FILENAME);
                // dd($filename);
                $path = Storage::exists('images');
                if($path == false){
                    Storage::makeDirectory('public/images','777',true);
                }
                $pathtosave = $file->storeAs('images', $name);
        } else {
            $filename = 'noimg';
        }

        $user = Post::create([
            'user_id' => Auth::user()->id,
            'post_title' => $request->post_title,
            'description' => $request->description,
            'image' => $name,
        ]);
        


        return redirect()->route('auth.userDashboard');            
       
    }
}
