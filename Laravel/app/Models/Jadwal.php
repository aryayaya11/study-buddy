<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal_sesi';
    protected $primaryKey = 'jadwal_id';

    protected $fillable = ['hari', 'sesi']; // sesi berupa waktu
}