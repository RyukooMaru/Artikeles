<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users'; // Nama tabel di database

    protected $primaryKey = 'userid'; // Sesuai field di database

    public $timestamps = true; // Kalo tabel ga pake created_at & updated_at

    protected $fillable = [
        'captcha_verified'
    ];
}
