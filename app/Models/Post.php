<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

   protected $table = 'post';

   protected $fillable = [
       'user_id',
       'post_title',
       'image',
       'description',
   ];

   public function comments()
    {
        return $this->hasMany(Comments::class,'post_id');
    }

   public function reaction()
    {
        return $this->hasMany(Reaction::class,'post_id');
    }
   public function notification()
    {
        return $this->hasMany(Notificatios::class,'post_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

   /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
  
}
