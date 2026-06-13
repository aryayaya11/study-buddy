@extends('layouts.app')
@section('title', 'Daftar Kelas Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-8 border-b border-slate-200 pb-4">
        <div>
            <h2 class="text-2xl font-bold text-blue-900 flex items-center gap-2">📝 Daftar Kelas Baru</h2>
            <p class="text-slate-500 text-sm mt-1">Pilih jenjang, mata pelajaran, dan jadwal sesi yang sesuai untuk Anda.</p>
        </div>
    </div>

    {{-- Pesan Error Validasi Server --}}
    @if (session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-start gap-3 shadow-sm">
            <svg class="w-5 h-5 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium text-sm">{{ session('error') }}</span>
        </div>
    @endif
    
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-4 rounded-xl mb-6 shadow-sm">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <span class="font-bold text-sm">Mohon perbaiki kesalahan berikut:</span>
            </div>
            <ul class="list-disc ml-8 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <form id="pendaftaran-form" action="{{ route('students.pendaftaran.store') }}" method="POST">
            @csrf
            
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Jenjang -->
                    <div>
                        <label for="jenjang_select" class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Jenjang</label>
                        <select name="jenjang" id="jenjang_select" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition @error('jenjang') border-red-500 bg-red-50 @enderror" required>
                            <option value="">-- Pilih Jenjang --</option>
                            @foreach ($jenjang as $j)
                                <option value="{{ $j }}">{{ strtoupper($j) }}</option>
                            @endforeach
                        </select>
                        @error('jenjang')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mapel -->
                    <div>
                        <label for="mapel_select" class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Mata Pelajaran</label>
                        <select name="mapel_id" id="mapel_select" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition disabled:opacity-50 disabled:bg-slate-100 disabled:cursor-not-allowed @error('mapel_id') border-red-500 bg-red-50 @enderror" required disabled>
                            <option value="">Pilih Jenjang Terlebih Dahulu</option>
                        </select>
                        @error('mapel_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Periode -->
                    <div>
                        <label for="periode_select" class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Periode Program</label>
                        <select name="durasi" id="periode_select" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition @error('durasi') border-red-500 bg-red-50 @enderror" required>
                            <option value="1">1 Bulan</option>
                            <option value="3">3 Bulan</option>
                            <option value="6">6 Bulan</option>
                        </select>
                        @error('durasi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sesi -->
                    <div>
                        <label for="sesi_select" class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">Jadwal Sesi</label>
                        <select name="jadwal_id" id="sesi_select" class="w-full bg-slate-50 border border-slate-300 text-slate-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition @error('jadwal_id') border-red-500 bg-red-50 @enderror" required>
                            <option value="">-- Pilih Jadwal --</option>
                            @foreach ($jadwal as $j)
                                <option value="{{ $j->jadwal_id }}">{{ $j->hari }} - Sesi {{ $j->sesi }}</option>
                            @endforeach
                        </select>
                        @error('jadwal_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Harga Box -->
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-blue-800 mb-1">Total Biaya Pendaftaran</p>
                        <p class="text-xs text-blue-600">Harga akan disesuaikan berdasarkan pilihan di atas.</p>
                    </div>
                    <div class="text-right">
                        <h3 id="harga-text" class="text-3xl font-extrabold text-blue-900">Rp. 0 <span class="text-sm font-medium text-blue-700">/ Program</span></h3>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 px-8 py-4 border-t border-slate-200 flex justify-end">
                <button type="submit" id="submit-button" class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-6 py-2.5 shadow-sm transition flex items-center gap-2">
                    Lanjut ke Pembayaran
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const form = document.getElementById('pendaftaran-form');
    const submitButton = document.getElementById('submit-button');
    const jenjangSelect = document.getElementById('jenjang_select');
    const mapelSelect = document.getElementById('mapel_select');
    const sesiSelect = document.getElementById('sesi_select');
    const periodeSelect = document.getElementById('periode_select');
    const hargaText = document.getElementById("harga-text");

    // Helper untuk memformat harga
    function formatRupiah(angka) {
        let number_string = angka.toString().replace(/[^,\d]/g, ''),
            sisa    = number_string.length % 3,
            rupiah  = number_string.substr(0, sisa),
            ribuan  = number_string.substr(sisa).match(/\d{3}/g);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return rupiah;
    }

    // FUNGSI UTAMA: MENGIRIM REQUEST HARGA
    function updateHarga() {
        let jenjang = jenjangSelect.value;
        let mapelId = mapelSelect.value;
        let sesiId = sesiSelect.value;
        let periode = parseInt(periodeSelect.value) || 1;

        // Jika salah satu nilai kunci (Jenjang, Mapel, Sesi) kosong, hentikan kalkulasi
        if (!jenjang || !mapelId || !sesiId) {
            hargaText.innerHTML = "Rp. 0 <span class=\"text-sm font-medium text-blue-700\">/ Program</span>";
            return;
        }

        const url = `/students/kelas/get-harga?jenjang=${jenjang}&mapel_id=${mapelId}&jadwal_id=${sesiId}`;
        
        fetch(url)
            .then(res => {
                if (!res.ok) {
                    throw new Error('Network response was not ok');
                }
                return res.json();
            })
            .then(data => {
                let hargaDasar = parseFloat(data.harga) || 0;
                let total = hargaDasar * periode;

                hargaText.innerHTML = `Rp. ${formatRupiah(total)} <span class="text-sm font-medium text-blue-700">/ Program</span>`;
            })
            .catch(error => {
                console.error('AJAX GAGAL saat mengambil harga:', error);
                hargaText.innerHTML = "Rp. Error <span class=\"text-sm font-medium text-blue-700\">/ Program</span>";
            });
    }

    // FUNGSI UNTUK MEMUAT MATA PELAJARAN BERDASARKAN JENJANG
    function updateMapel() {
        const jenjang = jenjangSelect.value;
        
        mapelSelect.innerHTML = '<option value="">Memuat...</option>';
        mapelSelect.disabled = true;

        if (!jenjang) {
            mapelSelect.innerHTML = '<option value="">-- Pilih Mata Pelajaran --</option>'; 
            updateHarga();
            return;
        }

        fetch(`{{ route('students.kelas.getMapel') }}?jenjang=${jenjang}`)
            .then(response => response.json())
            .then(data => {
                mapelSelect.innerHTML = '<option value="">-- Pilih Mata Pelajaran --</option>';

                let firstMapelId = null; 
                
                // Isi Dropdown Mapel
                data.forEach(mapel => {
                    const option = new Option(mapel.nama_mapel, mapel.mapel_id);
                    mapelSelect.appendChild(option);
                    
                    if (!firstMapelId) {
                        firstMapelId = mapel.mapel_id;
                    }
                });

                mapelSelect.disabled = false;
                
                // Auto-select: Paksa pilih Mapel pertama
                if (firstMapelId) {
                    mapelSelect.value = firstMapelId;
                }
                
                // Panggil updateHarga untuk memicu perhitungan awal setelah Mapel dimuat
                updateHarga(); 

            })
            .catch(error => {
                console.error('Error fetching mapel:', error);
                mapelSelect.innerHTML = '<option value="">Gagal memuat</option>';
            });
    }


    // --------------------------------------------------------
    // SETUP EVENT LISTENERS (Dipanggil saat DOM siap)
    // --------------------------------------------------------

    // Listener untuk Jenjang: Memuat Mata Pelajaran (lalu memicu updateHarga)
    jenjangSelect.addEventListener("change", updateMapel);

    // Listener untuk Mata Pelajaran, Periode, dan Sesi: Memicu updateHarga
    mapelSelect.addEventListener("change", updateHarga);
    sesiSelect.addEventListener("change", updateHarga);
    periodeSelect.addEventListener("change", updateHarga);
    
    // Perbaikan: Submit Handler untuk mencegah pengiriman value kosong
    form.addEventListener('submit', function(event) {
        // Cek kembali Mapel ID sebelum submit
        if (!mapelSelect.value) {
            event.preventDefault(); // Blok submit
            // Tampilkan pesan error inline
            mapelSelect.setCustomValidity("Mohon pilih Mata Pelajaran yang valid.");
            mapelSelect.reportValidity();
            return;
        }
    });

    // Pemicu Awal: Panggil updateMapel jika Jenjang sudah memiliki nilai
    if (jenjangSelect.value) {
        updateMapel();
    }
</script>
@endsection
