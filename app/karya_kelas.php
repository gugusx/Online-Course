<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hootlex\Moderation\Moderatable;
use Illuminate\Support\Facades\Auth;

class karya_kelas extends Model
{

    use Moderatable;

    protected $table    = 'karya_kelas';
    protected $fillable = ['user_id','jumlah_karya', 'deskripsi_karya', 'karyakelas_id', 'karyakelas_type'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function karyakelas()
    {
        return $this->morphTo();
    }

    public function karya_kelas()
    {
        return $this->morphMany('App\karya_kelas', 'karyakelas');
    }

    public function karya_comments()
    {
        return $this->morphMany('App\karya_comment', 'commentable');
    }

    public function likes()
    {
        return $this->morphMany('App\like', 'likeable')->whereDeletedAt(null);
    }

    public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(Auth::id())->first();
        return (!is_null($like)) ? true : false;
    }


}
