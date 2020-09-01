<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class webinar extends Model {
    protected $table    = 'webinar';
    protected $fillable = ['id', 'judul', 'isi', 'tanggal', 'jam', 'link', 'stat'];
}
