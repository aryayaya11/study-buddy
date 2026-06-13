<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;
use App\Models\Kelas;

class TutorMateriController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tutor = $user->tutor;

        // Ambil satu materi berdasarkan mapel yang diajarkan tutor
        $materi = null;
        if ($tutor && $tutor->mapel_id) {
            $materi = Materi::with('mapel')
                ->where('mapel_id', $tutor->mapel_id)
                ->first();
        }

        return view('tutor.materials', compact('materi'));
    }
}