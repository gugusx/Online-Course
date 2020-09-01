<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class modul extends Model
{
  protected $table 	  = 'modul';
  protected $fillable = ['id','judul' , 'isi', 'gambar', 'count', 'status', 'kategori_modul', 'jenis_id', 'jenjang_id', 'kelas_id', 'mapel_id', 'harga_lama', 'harga', 'sertifikat', 'trainer_id'];
}
