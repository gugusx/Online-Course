<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jenjang extends Model
{
    protected $table = 'jenjang';
    protected $fillable = ['id', 'nm_jenjang'];
}
