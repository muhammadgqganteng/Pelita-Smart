<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



    class BankSoal extends Model
{
    

    /** @use HasFactory<\Database\Factories\BankSoalFactory> */
    use HasFactory;
    protected $fillable = ['guru_id', 'jenis_soal', 'pertanyaan', 'skor'];

    public function pilihanJawaban()
    {
        return $this->hasMany(BankPilihanJawaban::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}


