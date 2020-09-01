<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategorivideo extends Model
{
  protected $table = 'Kategorivideo';
  protected $fillable = ['id', 'kategori', 'modul_id'];
}
