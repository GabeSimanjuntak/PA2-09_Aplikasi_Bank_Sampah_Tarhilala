<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSampah extends Model
{
    use HasFactory;

    protected $table = 'jenis_sampah'; // Nama tabel di database

    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'harga_per_kg',
        'gambar',
    ];
}
