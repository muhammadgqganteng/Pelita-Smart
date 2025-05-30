<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilUjian extends Model
{
    protected $table = "hasil_ujian";
     protected $fillable = [
        'ujian_id',
        'user_id',
        'waktu_mulai',
        'waktu_selesai',
        'nilai_otomatis',
        'nilai_esai',
        'nilai_akhir',
        'status',
        'jumlah_benar',
        'jumlah_salah',
     ];

     public function user(){
        return $this->belongsTo(User::class, );
     }
     public function Ujian(){
        return $this->belongsTo( Ujian::class, );
     }

     public function JawabanSiswa(){
        return $this->hasMany(JawabanSiswa::class);
     }
     public function JawabanEsai(){
        return $this->hasMany(JawabanEsai::class);
     }

}
