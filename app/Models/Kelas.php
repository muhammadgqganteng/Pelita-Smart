<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = "kelas";
    protected $fillable = ['nama_kelas', 'deskripsi'];
    public function User()
    {
        return $this->hasMany(User::class, 'user_id');
    }
    
}
