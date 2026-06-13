<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pendaftaran;

class Siswa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'siswa';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    public $incrementing = false;      // kalau user_id bukan auto increment
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'jenjang',
    ];
    
    // Relasi "belongs to" ke tabel 'users'
    // Setiap siswa dimiliki oleh satu user
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Relasi ke tabel 'pendaftaran'

public function pendaftarans()
{
    return $this->hasMany(Pendaftaran::class, 'user_id', 'user_id');
}


    // Relasi ke tabel 'kelas'
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'user_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id'); 
        // foreign key di siswa = user_id, primary key di users = user_id
    }
}