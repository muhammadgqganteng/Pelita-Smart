<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KotakSaran extends Model
{
    /** @use HasFactory<\Database\Factories\KotakSaranFactory> */
    use HasFactory;
    protected $table = 'kotak_saran';
    protected $fillable = [
        'nama',
        'email',
        'isi_saran',
    ];
    public function matapeljajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
