<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sfk extends Model
{
  	protected $table = 'sfk_video';
    protected $fillable = ['id', 'judul', 'embed', 'user_id', 'approval'];
}
