<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mapel extends Model
{
  	protected $table 	= 'mapel';
    protected $fillable	= ['id', 'nm_mapel', 'gambar', 'jenis'];
}
