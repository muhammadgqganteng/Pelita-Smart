<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilUjian extends Model
{
    protected $table = "hasil_ujian"; // Pastikan nama tabel di DB adalah 'hasil_ujian'
    protected $fillable = [
        'ujian_id',
        'user_id', // Ini adalah ID murid
        'waktu_mulai',
        'waktu_selesai',
        'nilai_otomatis', // Untuk PG
        'nilai_esai',     // Untuk Esai
        'nilai_akhir',    // Total nilai
        'status',         // Contoh: 'completed', 'submitted'
        'jumlah_benar',
        'jumlah_salah',
    ];

    // Relasi ke User (Murid)
    public function murid()
    {
        // Parameter kedua (user_id) adalah foreign key di tabel hasil_ujian
        // Parameter ketiga (id) adalah local key di tabel users
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relasi ke Ujian
    public function ujian()
    {
        // Parameter kedua (ujian_id) adalah foreign key di tabel hasil_ujian
        return $this->belongsTo(Ujian::class, 'ujian_id');
    }

    // *** Revisi Penting: Relasi JawabanSiswa & JawabanEsai ***
    // Jika Anda memiliki satu tabel 'jawaban_ujian_murid' seperti yang kita diskusikan sebelumnya
    // yang menyimpan semua jawaban (baik PG maupun Esai), maka Anda hanya butuh satu relasi ini.
    public function jawabanUjianMurid() // Nama relasi lebih deskriptif
    {
        // Jika tabel jawaban_ujian_murid memiliki foreign key 'hasil_ujian_id'
        // return $this->hasMany(JawabanUjianMurid::class, 'hasil_ujian_id', 'id');
        // Jika tabel jawaban_ujian_murid langsung berelasi ke user_id dan ujian_id
        return $this->hasMany(JawabanUjianMurid::class, 'user_id', 'user_id')
                    ->where('ujian_id', $this->ujian_id); // Filter berdasarkan ujian_id
    }


    public function Soal() { return $this->belongsTo(Soal::class); }
    // public function SoalTugas() { return $this->belongsTo(SoalTugas::class); }
    public function JawabanSiswa() { return $this->hasMany(JawabanSiswa::class, 'ujian_id','hasil_ujian_id'); }
}