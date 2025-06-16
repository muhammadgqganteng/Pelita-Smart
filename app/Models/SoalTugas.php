<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalTugas extends Model
{
    protected $fillable = ['tugas_id', 'bank_soal_id'];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function bankSoal()
    {
        return $this->belongsTo(BankSoal::class);
    }
    public function soal()
    {
        return $this->hasMany(Soal::class, 'bank_soal_id', 'bank_soal_id');
    }

}

