<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function getTotalSksAttribute()
{
    // Pastikan relasi KRS dan Matakuliah ada
    if ($this->krs->isEmpty()) {
        return null;
    }

    return $this->krs->sum(function ($krs) {
        return $krs->matakuliah->sks ?? 0;
    });
}


    public function getSemesterAttribute(): int
{
    $tanggalMasuk = Carbon::parse($this->tanggal_masuk_mhs);
    $now = Carbon::now();

    $diffInMonths = $tanggalMasuk->diffInMonths($now);
    return intdiv($diffInMonths, 6) + 1; // 1 semester tiap 6 bulan
}
}
