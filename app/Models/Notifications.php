<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

   protected $table = 'notification';

   protected $fillable = [
       'user_id',
       'post_id',
       'notification_status',
       'reaction_id',
       'liked',
       'dislike',
       
   ];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function reaction()
    {
        return $this->belongsTo(Reaction::class,'reaction_id');
    }


    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }

}
