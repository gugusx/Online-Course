<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class rating extends Model
{
    protected $table = 'ratings';
    protected $fillable = ['id', 'user_id', 'rating', 'content_ulasan', 'rateable_id', 'rateable_type'];

    use Rateable;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function ratetable()
    {
        return $this->morphTo();
    }

    public function ratings()
    {
        return $this->morphMany('App\rating', 'ratetable');
    }
}
