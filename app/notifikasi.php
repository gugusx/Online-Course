<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notifikasi extends Model
{
    protected $table = 'notifikasi';
    protected $fillable = ['id', 'notif', 'user_id', 'read', 'link', 'about'];
}
