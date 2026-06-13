<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\JadwalSesi;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'kelas_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'tutor_id',
        'user_id',
        'mapel_id',
        'jenjang',
        'jadwal_id'
    ];

    // Relasi ke mapel
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id', 'mapel_id');
    }

    // Relasi ke tutor
    public function tutor()
    {
    return $this->belongsTo(Tutor::class, 'tutor_id', 'tutor_id');
    }


    // Relasi ke jadwal sesi
    public function jadwal()
{
    return $this->belongsTo(JadwalSesi::class, 'jadwal_id', 'jadwal_id');
}

// Relasi ke siswa (opsional, kalau butuh)
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'user_id', 'user_id');
    }

}