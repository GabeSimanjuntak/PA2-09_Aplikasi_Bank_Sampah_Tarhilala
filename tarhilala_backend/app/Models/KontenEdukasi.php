<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontenEdukasi extends Model
{
    protected $table = 'konten_edukasi';
    protected $fillable = ['judul', 'slug', 'isi', 'thumbnail', 'penulis_id', 'status'];

    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }
}
