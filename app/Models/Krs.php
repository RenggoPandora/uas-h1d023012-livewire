<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $fillable = ['mahasiswa_id', 'matakuliah_id', 'semester'];

    public function mahasiswa()
{
    return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
}

public function matakuliah()
{
    return $this->belongsTo(Matakuliah::class, 'matakuliah_id');
}

}
