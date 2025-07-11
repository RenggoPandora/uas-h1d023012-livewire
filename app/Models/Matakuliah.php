<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';

    protected $fillable = [
        'kode',
        'nama_mk',
        'sks',
        'tipe',
        'semester',
    ];
}
