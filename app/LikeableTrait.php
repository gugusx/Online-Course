<?php

namespace App;

use Illuminate\Support\Facades\Auth;

trait LikeableTrait
{

    public function likes()
    {
        return $this->morphMany('App\like', 'likeable');
    }

    public function likeComment()
    {
        $like = new like();
        $like->user_id = Auth::user()->id;

        $this->likes()->save($like);
        return $like;
    }
}

?>