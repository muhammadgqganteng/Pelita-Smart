<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = ['ebook_id', 'title', 'content'];

    public function ebook() {
        return $this->belongsTo(Ebook::class);
    }
}

