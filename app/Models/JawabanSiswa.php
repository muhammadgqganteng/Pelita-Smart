<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanSiswa extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
    protected $table = "jawaban_siswa";
        protected $fillable = [
        'hasil_ujian_id',
        'user_id',
        'ujian_id',
        'soal_id',
        'pilihan_id',
        'jawaban_isian',
        'pasangan_jawaban',
        'is_correct',     // Tambahkan ini
        'score_obtained', // Tambahkan ini
        'correct_answer_text', // Tambahkan ini

    ];
     protected $casts = [
        'pasangan_jawaban' => 'array', // Pastikan kolom JSON dicasting ke array
        'is_correct' => 'boolean', // Pastikan kolom boolean dicasting
    ];
    // public function Ujian()
    // {
    //     return $this->hasMany(Ujian::class);
    // }
      public function hasilUjian()
    {
        return $this->belongsTo(HasilUjian::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }

    public function pilihanJawaban()
    {
        return $this->belongsTo(PilihanJawaban::class, 'pilihan_id');
    }
}
