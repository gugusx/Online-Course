<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class balasan_pesan extends Model
{
    protected $fillable = ['user_id', 'pesan_id', 'balasan_pesan', 'lampiran'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
