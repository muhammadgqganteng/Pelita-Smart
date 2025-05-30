<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankPilihanJawaban extends Model
{
    protected $fillable = ['bank_soal_id', 'jawaban', 'benar'];

    public function bankSoal()
    {
        return $this->belongsTo(BankSoal::class);
    }
}
