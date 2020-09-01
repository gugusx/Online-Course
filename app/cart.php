<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $table    = 'cart';
  	protected $fillable = ['user_id', 'modul_id', 'stcart', 'transaksi_id'];
}
