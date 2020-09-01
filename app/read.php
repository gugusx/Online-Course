<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class read extends Model
{
  protected $table='read';
    protected $fillable=['id','user_id','video_id'];
}
