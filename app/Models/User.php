<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user'; 
    protected $fillable = ['username', 'nameuse','password','improfil'];
    public $timestamps = true;
}
