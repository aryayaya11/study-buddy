<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    public function index()
    {
        // Ambil siswa yang punya transaksi dengan status 'paid'
        $students = User::where('role', 'siswa')
            ->whereHas('pendaftarans.transaksi', function ($query) {
                $query->where('status_bayar', 'paid');
            })
            ->get();

        return view('admin.students.index', compact('students'));
    }
}
