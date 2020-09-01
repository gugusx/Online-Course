<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class email extends Model
{
  protected $table    = 'email';
  protected $fillable = ['isi', 'judul', 'user_id'];
}
