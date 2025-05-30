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
}
