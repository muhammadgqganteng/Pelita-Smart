<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $fillable = ['title', 'cover_image', 'file', 'description'];

public function chapters() {
    return $this->hasMany(Chapter::class);
}

}
