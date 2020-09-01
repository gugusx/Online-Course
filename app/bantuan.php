<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hootlex\Moderation\Moderatable;

class bantuan extends Model
{
    use Moderatable;

    protected $fillable = ['user_id', 'subjek', 'kategori_layanan', 'prioritas', 'pesan', 'lampiran'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
