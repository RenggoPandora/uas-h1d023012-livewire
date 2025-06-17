<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    public function mahasiswa()
{
    return $this->belongsTo(Mahasiswa::class, 'id_mhs');
}

public function matakuliah()
{
    return $this->belongsTo(Matakuliah::class, 'id_mk');
}

}
