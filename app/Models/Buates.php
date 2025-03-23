<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buates extends Model
{
    use HasFactory;

    protected $table = 'artikeles';
    protected $fillable = [
        'userid',
        'judul',
        'lseo',
        'kseo',
        'konten',
        'deltime',
        'delmode',
    ];
}
