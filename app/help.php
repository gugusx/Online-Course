<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class help extends Model
{

    protected $table='help';
      protected $fillable=['id','judul','keterangan'];
}
