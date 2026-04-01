<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'nama',
        'email',
        'nomor_telepon',
        'password',
        'role',
        'reset_token',
        'reset_token_expired_at'
    ];

    protected $hidden = [
        'password'
    ];

    public $timestamps = true;
}
