<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $table = 'reward';
    protected $fillable = [
        'nama_reward',
        'deskripsi',
        'poin_dibutuhkan',
        'stok',
        'gambar',
        ];

    // Matikan timestamps karena di tabel hanya ada created_at
    public $timestamps = false;
}
