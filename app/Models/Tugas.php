<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    /** @use HasFactory<\Database\Factories\TugasFactory> */
    use HasFactory;
    protected $fillable = [
        'guru_id',
        'judul',
        'deskripsi',
        'tanggal_deadline',
    ];
    protected $table = 'tugas';
    public function soal()
    {
        return $this->hasMany(Soal::class);
    }
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
    public function soalTugas()
{
    return $this->hasMany(SoalTugas::class, 'tugas_id');
}


}
