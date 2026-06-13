<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapel';
    protected $primaryKey = 'mapel_id';
    // PERBAIKAN: mapel_id adalah STRING (VARCHAR), jadi matikan auto-increment
    public $incrementing = false; 
    // PERBAIKAN: Tipe primary key adalah string
    protected $keyType = 'string'; 

    protected $fillable = [
        'nama_mapel',
        'jenjang',
    ];
    
    public function kelas()
    {
        return $this->hasMany(KelasPendaftaran::class, 'mapel_id', 'mapel_id');
    }
    public function materi()
    {
        return $this->hasMany(Materi::class, 'mapel_id', 'mapel_id');
    }
}
