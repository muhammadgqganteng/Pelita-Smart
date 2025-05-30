<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $table = "ujian";
 protected $fillable = [
        'nama_ujian',
        'deskripsi',
        'mata_pelajaran_id',
        'kelas_id',
        'guru_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'waktu_ujian',
        'jumlah_soal',
        'jenis_ujian',
        'status',
        'acak_soal',
        'acak_jawaban',
        'nilai_lulus',
        'instruksi_khusus',
    ];
// buat hasmany
public function soal(){
    return $this->hasMany(Soal::class);
}
public function HasilUjian(){
    return $this->hasMany(HasilUjian::class);
}
public function MataPelajarans(){
    return $this->hasMany(MataPelajaran::class);
}
   public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    // Relasi ke Kelas (jika ujian terkait dengan kelas tertentu)
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}

