<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'pendaftaran_id',
        'metode_bayar',
        'jumlah',
        'status_bayar',
        'bukti_bayar',
    ];

    // Relasi ke Pendaftaran
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id', 'daftar_id');
    }
}