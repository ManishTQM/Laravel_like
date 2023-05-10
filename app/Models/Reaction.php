<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Reaction extends Model
{
    use HasFactory;

    protected $table = 'reaction';

    protected $fillable = [
        'user_id',
        'post_id',
        'upvote',
        'downvote',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }
    public function notification()
    {
        return $this->hasMany(Notificatios::class,'id');
    }
}
