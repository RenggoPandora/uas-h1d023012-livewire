<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $fillable = [
        'nim',
        'nama_mhs',
        'email',
        'prodi_id',
        'tanggal_masuk_mhs',
        'status',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }
}
