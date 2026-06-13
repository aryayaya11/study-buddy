@extends('layouts.app_admin')
@section('title', 'Manajemen Admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8 border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-2xl font-bold text-blue-900 flex items-center gap-2">⚙️ Manajemen Admin</h2>
            <p class="text-slate-500 text-sm mt-1">Kelola akun administrator sistem dan wewenangnya.</p>
        </div>
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Form Tambah Admin --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 mb-8">
        <h3 class="text-lg font-bold text-slate-800 mb-5 border-b border-slate-100 pb-2">➕ Tambah Admin Baru</h3>
        <form action="{{ route('admin.admins.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 items-end">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Nama Lengkap" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Email</label>
                <input type="email" name="email" placeholder="admin@example.com" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Password</label>
                <input type="password" name="password" placeholder="Minimal 8 karakter" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">No WhatsApp</label>
                <input type="text" name="no_whatsapp" placeholder="08..." class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition" required>
                    <option value="">Pilih</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-5 py-2.5 shadow-sm transition">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>

    {{-- Tabel Daftar Admin --}}
    <div class="bg-white shadow-sm border border-slate-200 rounded-xl overflow-hidden">
        <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
            <h3 class="font-bold text-slate-800">Daftar Administrator Sistem ({{ $admins->count() }})</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white border-b border-slate-200 text-slate-500 text-xs uppercase tracking-wider font-semibold">
                        <th class="px-6 py-4">ID Admin</th>
                        <th class="px-6 py-4">Nama Lengkap</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Kontak</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($admins as $admin)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-slate-600 font-medium">#{{ $admin->user_id }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-800">
                                {{ $admin->nama }}
                                <span class="block text-xs text-slate-400 mt-1 font-normal">{{ $admin->jenis_kelamin == 'L' ? 'Laki-laki' : ($admin->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</span>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $admin->email }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $admin->no_whatsapp ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button onclick="openEditModal({{ json_encode($admin) }})" class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition-colors text-sm font-medium border border-blue-200">
                                        Edit
                                    </button>
                                    <form action="{{ route('admin.admins.destroy', $admin->user_id) }}" method="POST" onsubmit="return confirm('Peringatan: Yakin ingin menghapus admin ini secara permanen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors text-sm font-medium border border-red-200">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center">
                            <div class="text-5xl mb-3 opacity-50">👑</div>
                            <h3 class="text-lg font-bold text-slate-700 mb-1">Belum Ada Admin</h3>
                            <p class="text-slate-500 text-sm">Gunakan form di atas untuk mendaftarkan administrator baru.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div id="editModal" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-xl shadow-2xl w-[420px] border border-slate-200">
        <h3 class="text-xl font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">✏️ Edit Data Admin</h3>
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Nama Lengkap</label>
                <input type="text" name="nama" id="editNama" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Email</label>
                <input type="email" name="email" id="editEmail" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition" required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">No WhatsApp</label>
                <input type="text" name="no_whatsapp" id="editWhatsApp" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="editGender" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Password (Opsional)</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak diubah" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition">
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(admin) {
        document.getElementById('editForm').action = `/admin/admins/${admin.user_id}`;
        document.getElementById('editNama').value = admin.nama;
        document.getElementById('editEmail').value = admin.email;
        document.getElementById('editWhatsApp').value = admin.no_whatsapp ?? '';
        document.getElementById('editGender').value = admin.jenis_kelamin ?? 'L';
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
@endsection
