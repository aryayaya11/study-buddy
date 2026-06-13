<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSesi extends Model
{
    use HasFactory;

    protected $table = 'jadwal_sesi';
    protected $primaryKey = 'jadwal_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'hari',
        'sesi',
    ];

    // Tambahkan casting untuk memastikan jadwal_id selalu dibaca sebagai integer/angka.
    protected $casts = [
        'jadwal_id' => 'integer',
    ];

    // Relasi ke kelas
    public function kelas()
    {
        return $this->hasMany(KelasPendaftaran::class, 'jadwal_id', 'jadwal_id');
    }
}
