<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class karya_comment extends Model
{

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function karya_comments()
    {
        return $this->morphMany('App\karya_comment', 'commentable');
    }
}
