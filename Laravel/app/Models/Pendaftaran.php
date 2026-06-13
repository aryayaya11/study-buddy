<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $primaryKey = 'daftar_id';
    public $timestamps = false;

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'status',
        'tanggal_daftar',
        'durasi',
        'transaksi_id',
    ];

    /**
     * Relasi ke tabel users (sebagai siswa).
     * siswa_id -> user_id
     */
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id', 'user_id');
    }

    /**
     * Alias agar bisa dipanggil sebagai siswaData di controller lain.
     */
    public function siswaData()
    {
        return $this->belongsTo(User::class, 'siswa_id', 'user_id');
    }

    /**
     * Relasi ke tabel kelas_pendaftaran.
     */
    public function kelas()
    {
        return $this->belongsTo(KelasPendaftaran::class, 'kelas_id', 'kelas_id');
    }

    /**
     * Relasi ke tabel transaksi.
     */
    public function transaksi()
    {
        return $this->hasOne(\App\Models\Transaksi::class, 'pendaftaran_id', 'daftar_id');
    }

}
