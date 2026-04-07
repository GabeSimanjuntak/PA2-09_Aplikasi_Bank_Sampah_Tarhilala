<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPenjemputan extends Model
{
    protected $table = 'jadwal_penjemputan';
    protected $fillable = ['rute_id', 'driver_id', 'hari', 'jam_mulai', 'jam_selesai'];

    public function rute() {
        return $this->belongsTo(Rute::class, 'rute_id');
    }

    public function driver() {
        return $this->belongsTo(User::class, 'driver_id');
    }
    public $timestamps = false;
}
