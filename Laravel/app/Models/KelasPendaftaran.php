<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'kelas_pendaftaran';
    protected $primaryKey = 'kelas_id';
    public $timestamps = false;
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'mapel_id',
        'jenjang',
        'deskripsi',
        'harga',
        'jadwal_id',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'jadwal_id' => 'integer',
        'kelas_id' => 'integer',
    ];

    /**
     * Relasi ke tabel Mapel
     * Satu kelas hanya memiliki satu mapel.
     */
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id', 'mapel_id');
    }

    /**
     * Relasi ke tabel Jadwal Sesi
     * Satu kelas memiliki satu jadwal tertentu.
     */
    public function jadwal()
    {
        return $this->belongsTo(JadwalSesi::class, 'jadwal_id', 'jadwal_id');
    }

    /**
     * Relasi ke tabel Pendaftaran
     * Satu kelas bisa memiliki banyak siswa yang mendaftar.
     */
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'kelas_id', 'kelas_id');
    }
}
