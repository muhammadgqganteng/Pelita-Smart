<?php

namespace App\Models;

use App\Models\BankPilihanJawaban;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use controllers\Guru\BankSoalController;



    class BankSoal extends Model
{
    

    /** @use HasFactory<\Database\Factories\BankSoalFactory> */
    use HasFactory;
    protected $fillable = ['guru_id', 'jenis_soal', 'pertanyaan', 'skor'];

// BankSoal.php
public function pilihanGanda()
{
    return $this->hasMany(BankPilihanJawaban::class, 'bank_soal_id');
}


    public function guru()
    {
        return $this->belongsTo(User::class, );
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
public function ujian()
{
    return $this->belongsTo(Ujian::class, );
}
public function kategori_soal()
{
    return $this->belongsTo(KategoriSoal::class, );       
}
public function pilihanJawaban()
{
    return $this->hasMany(PilihanJawaban::class, 'soal_id');
}

public function JawabanIsian()
{
    return $this->hasMany(JawabanIsian::class, );
}

public function PasanganMenjodohkan()
{
    return $this->hasMany(PasanganMenjodohkan::class, );
}




}


