<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = "mata_pelajarans";
    protected $fillable = [ "nama_mapel","deskripsi"];
    
public function Ujian()
{
    return $this->hasMany(Ujian::class, );
}
}
