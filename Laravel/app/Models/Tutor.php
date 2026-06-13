<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $table = 'tutors';
    protected $primaryKey = 'tutor_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['tutor_id', 'mapel_id', 'pengalaman', 'rating', 'is_active', 'nama_tutor', 'user_id'];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id', 'mapel_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'tutor_id', 'user_id');
    }

    public function getNamaTutorAttribute()
    {
        return $this->user->name ?? 'N/A';
    }
}