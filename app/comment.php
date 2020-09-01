<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class comment extends Model
{
    use LikeableTrait;

    protected $table = 'comments';
    protected $fillable = ['id', 'user_id', 'content', 'commentable_id', 'commentable_type'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->morphMany('App\comment', 'commentable');
    }

    public function likes(){
        return $this->belongsTo('App\like');
      }


}
