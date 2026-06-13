<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.admins.index', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'no_whatsapp' => 'nullable|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_whatsapp' => $request->no_whatsapp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'role' => 'admin',
        ]);

        return back()->with('success', 'Admin baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $admin = User::where('user_id', $id)->where('role', 'admin')->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $admin->user_id . ',user_id',
            'no_whatsapp' => 'nullable|string|max:15',
            'jenis_kelamin' => 'required|in:L,P',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'no_whatsapp' => $request->no_whatsapp,
            'jenis_kelamin' => $request->jenis_kelamin,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return back()->with('success', 'Data admin berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::where('user_id', $id)->where('role', 'admin')->delete();
        return back()->with('success', 'Admin berhasil dihapus!');
    }
}