<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historysearch extends Model
{
    use HasFactory;

    protected $table = 'historysearch';
    protected $fillable = [
        'historyid',
        'userid',
        'history',
    ];
}
