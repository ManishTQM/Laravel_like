<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\Notifications;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Storage;

class ReactionController extends Controller
{
    public function upVote(Request $request)
    {
       $reaction=Reaction::where('user_id',$request->user_id)->where('post_id',$request->post_id)->first();
       if($reaction == null){
        $user = Reaction::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'upvote' => 1,
            'downvote' => 0,
        ]);
        
        $notification=Notifications::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'notification_status'=>0,
            'reaction_id'=>$user->id,
            'liked'=>1,
            'dislike'=>0,
           


        ]);
        echo json_encode(array(
            "status" => 1,
            "message" => "like",
        ));
        $data=$this->userNotication($notification);
       }else{
        
        if ($reaction->upvote == 1) {
            $reaction->upvote = 0;
            $reaction->downvote = 0;
            $reaction->update();
            $notification=Notifications::find($reaction->id);
            $notification->liked=0;
            $notification->dislike=0;
            $notification->notification_status=0;
            $notification->update();

            echo json_encode(array(
                "status" => 1,
                "message" => "remove like",
            ));
            $data=$this->userNotication($notification);
        }else{
            $reaction->upvote = 1;
            $reaction->downvote = 0;
            $reaction->update();
            $notification=Notifications::find($reaction->id);
            $notification->notification_status = 0;
            $notification->liked=1;
            $notification->dislike=0;
            $notification->update();
            echo json_encode(array(
                "status" => 1,
                "message" => "add like",
            ));
            $data=$this->userNotication($notification);
        }
       }
    }

    public function downVote(Request $request)
    {
        $reaction=Reaction::where('user_id',$request->user_id)->where('post_id',$request->post_id)->first();
    
       if($reaction == null){
        
        $user = Reaction::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'downvote' => 1,
        ]); 
        $notification=Notifications::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'notification_status'=>0,
            'reaction_id'=>$user->id,
            'liked'=>0,
            'dislike'=>1,
        

        ]);
        echo json_encode(array(
            "status" => 1,
            "message" => "like",
        ));
        $data=$this->userNotication($notification);

       }else{
        
        if ($reaction->downvote == 1) {
            // dd($reaction->id);
            $reaction->upvote = 0;
            $reaction->downvote = 0;
            $reaction->update();
            $notification=Notifications::find($reaction->id);
            $notification->liked=0;
            $notification->dislike=0;
            $notification->notification_status=0;
            $notification->update();
            
            echo json_encode(array(
                "status" => 1,
                "message" => "remove dislike",
            ));
            $data=$this->userNotication($notification);
        }else{
            $reaction->upvote = 0;
            $reaction->downvote = 1;
            $reaction->update();
            $notification=Notifications::find($reaction->id);
            $notification->liked=0;
            $notification->dislike=1;
            $notification->notification_status=0;
            $notification->update();
            echo json_encode(array(
                "status" => 1,
                "message" => "add dislike",
            ));
            $data=$this->userNotication($notification);
        }
    
       }
    }

    public function userNotication($notification){
       
        $notifications=User::where('id',$notification->user_id)->first();
        $datas=Post::where('id',$notification->post_id)->first();
        $user=User::where('id',$datas->user_id)->first();
        return view('auth.notification',compact('user','notifications','datas'));

    }
    public function notifyUser(Request $request,$id){

       $notifications=Notifications::find($id);
       $notifications->notification_status = 1;
       $notifications->update();
       return redirect()->route('auth.userDashboard');


    }

}
