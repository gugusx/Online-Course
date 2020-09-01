<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table 	= "transaksi";
    protected $fillable = ['id', 'kode', 'user_id', 'harga', 'total', 'bank_id', 'status', 'end'];
}
