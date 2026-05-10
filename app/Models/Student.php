<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $fillable = ['npm', 'name', 'email', 'prodi', 'angkatan', 'status', 'gender', 'phone'];
}
