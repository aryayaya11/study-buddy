<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorAssignment extends Model
{
    protected $table = 'tutor_assignments';
    protected $fillable = ['tutor_id','mapel_id','jenjang'];

    public function tutor()
    {
        return $this->belongsTo(\App\Models\Tutor::class, 'tutor_id', 'tutor_id');
    }

    public function mapel()
    {
        return $this->belongsTo(\App\Models\Mapel::class, 'mapel_id', 'mapel_id');
    }
}
