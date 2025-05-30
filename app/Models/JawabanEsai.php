<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanEsai extends Model
{
    protected $table = "jawaban_esai";
 protected $fillable = [
        'hasil_ujian_id',
        'soal_id',
        'jawaban',
        'skor_diberikan',
        'komentar_guru',
    ];
    public function jawaban()
    {
        return $this->belongsTo(HasilUjian::class, 'hasil_ujian_id');
    }
    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id');
    }
    public function hasilUjian()
    {
        return $this->belongsTo(HasilUjian::class, 'hasil_ujian_id');
    }
}
