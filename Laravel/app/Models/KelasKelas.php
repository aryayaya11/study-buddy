<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasKelas extends Model
{
    use HasFactory;

    protected $table = 'kelas_kelas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'kelas_id',
        'siswa_id',
        'tutor_id',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id', 'tutor_id');
    }

    public function kelas()
    {
        return $this->belongsTo(KelasPendaftaran::class, 'kelas_id', 'kelas_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'user_id');
    }
}