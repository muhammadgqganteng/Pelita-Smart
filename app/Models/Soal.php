<?php

namespace App\Models;

use App\Models\Ujian;
use App\Models\KategoriSoal;
use App\Models\PilihanJawaban;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';
 protected $fillable = [
        'ujian_id',
        'kategori_soal_id',
        'pertanyaan',
        'jenis_soal',
        'skor',
        'waktu_pengerjaan',
        'gambar_pertanyaan',
    ];

public function ujian()
{
    return $this->belongsTo(Ujian::class, );
}
public function kategori_soal()
{
    return $this->belongsTo(KategoriSoal::class, );       
}
public function PilihanJawaban()
{   
    return $this->hasMany(PilihanJawaban::class, );
}
public function JawabanIsian()
{
    return $this->hasMany(JawabanIsian::class, );
}

public function PasanganMenjodohkan()
{
    return $this->hasMany(PasanganMenjodohkan::class, );
}
// Soal.php

public function pilihanGanda()
{
    return $this->hasMany(PilihanJawaban::class);
}
public function tugas()
{
    return $this->belongsTo(Tugas::class);
}


}
