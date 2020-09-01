<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class video extends Model {
    protected $table    = 'video';
    protected $fillable = ['id', 'embed', 'judul', 'kategorivideo_id', 'list', 'stat', 'durasi'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->morphMany('App\comment', 'commentable');
    }
    
    public function karya_comments()
    {
        return $this->morphMany('App\karya_comment', 'commentable');
    }

    public function ratings()
    {
        return $this->morphMany('App\rating', 'rateable');
    }

    public function karya_kelas()
    {
        return $this->morphMany('App\karya_kelas', 'karyakelas');
    }
    

}
