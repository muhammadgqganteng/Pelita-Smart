<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PilihanJawaban extends Model
{
    protected $table = "pilihan_jawaban";
        protected $fillable = [
        'soal_id',
        'pilihan',
        'jawaban',
        'benar',
    ];
public function soal()
{
    return $this->belongsTo(Soal::class, );       
}
    
}
