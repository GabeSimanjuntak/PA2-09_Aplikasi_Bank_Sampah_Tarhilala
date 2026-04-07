<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    protected $table = 'rute';
    protected $fillable = ['nama_rute', 'wilayah'];

    public function jadwal() {
        return $this->hasMany(JadwalPenjemputan::class, 'rute_id');
    }

    public $timestamps = false;
}
