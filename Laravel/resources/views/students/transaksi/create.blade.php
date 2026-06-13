@extends('layouts.app')

@section('content')
<section class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md border border-slate-100">
    <h2 class="text-2xl font-bold text-blue-900 mb-6 flex items-center gap-2">💳 Konfirmasi Pembayaran</h2>

    @if($errors->any())
      <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
        <ul class="list-disc ml-5">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="bg-slate-50 p-6 rounded-xl border border-slate-200 space-y-3 mb-8">
      <div class="flex justify-between items-center border-b border-slate-200 pb-2">
        <span class="text-slate-500 font-medium">ID Pendaftaran:</span>
        <span class="font-semibold text-slate-800">{{ $pendaftaran->daftar_id }}</span>
      </div>
      <div class="flex justify-between items-center border-b border-slate-200 pb-2">
        <span class="text-slate-500 font-medium">Nama Siswa:</span>
        <span class="font-semibold text-slate-800">{{ $pendaftaran->siswa->nama_siswa ?? Auth::user()->name }}</span>
      </div>
      <div class="flex justify-between items-center border-b border-slate-200 pb-2">
        <span class="text-slate-500 font-medium">Metode Bayar:</span>
        <span class="font-semibold text-slate-800">{{ ucfirst($transaksi->metode_bayar ?? 'Transfer') }}</span>
      </div>
      <div class="flex justify-between items-center border-b border-slate-200 pb-2">
        <span class="text-slate-500 font-medium">Status:</span>
        <span class="font-semibold px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
          {{ $transaksi->status_bayar === 'menunggu_verifikasi' ? 'Menunggu Verifikasi' : ucfirst($transaksi->status_bayar ?? 'Pending') }}
        </span>
      </div>
      <div class="flex justify-between items-center pt-2">
        <span class="text-slate-500 font-medium">Total Tagihan:</span>
        <span class="text-2xl font-bold text-blue-700">Rp {{ number_format($harga, 0, ',', '.') }}</span>
      </div>
    </div>

    <form action="{{ route('students.transaksi.store', $pendaftaran->daftar_id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf

      <div>
        <label for="metode_bayar" class="block font-semibold text-slate-700 mb-2">Pilih Metode Pembayaran</label>
        <select id="metode_bayar" name="metode_bayar" required class="w-full border border-slate-300 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 rounded-lg p-3 outline-none transition">
          <option value="">-- Pilih Metode --</option>
          <option value="transfer" {{ $transaksi->metode_bayar == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
          <option value="qris" {{ $transaksi->metode_bayar == 'qris' ? 'selected' : '' }}>QRIS</option>
        </select>
      </div>

      <!-- Informasi QRIS -->
      <div id="qris-preview" class="hidden bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
        <p class="font-medium text-blue-900 mb-4">Scan QR berikut untuk membayar melalui QRIS:</p>
        <div class="bg-white p-4 inline-block rounded-xl shadow-sm border border-slate-100">
            <img src="{{ asset('images/qris-example.png') }}" alt="QRIS Study Buddy" class="w-48 h-48 object-cover">
        </div>
        <p class="text-sm text-slate-500 mt-4">Pastikan nominal transfer sesuai dengan total tagihan.</p>
      </div>

      <!-- Informasi Transfer Bank -->
      <div id="transfer-info" class="hidden bg-green-50 border border-green-200 rounded-lg p-6 text-center">
        <p class="font-medium text-green-900 mb-2">Silakan transfer ke rekening berikut:</p>
        <div class="bg-white px-6 py-4 inline-block rounded-lg shadow-sm border border-green-100 mt-2">
            <p class="text-lg text-slate-500">Bank BCA</p>
            <p class="text-2xl font-bold text-slate-800 tracking-wider">1234 5678 90</p>
            <p class="text-sm text-slate-500 mt-1">a.n. Study Buddy</p>
        </div>
      </div>

      <div>
        <label for="jumlah" class="block font-semibold text-slate-700 mb-2">Jumlah Pembayaran (Rp)</label>
        <input type="number" id="jumlah" name="jumlah" value="{{ $harga }}" readonly class="w-full border border-slate-300 bg-slate-100 text-slate-600 rounded-lg p-3 cursor-not-allowed">
      </div>

      <div>
        <label for="bukti" class="block font-semibold text-slate-700 mb-2">Upload Bukti Pembayaran</label>
        <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:border-blue-500 transition cursor-pointer bg-slate-50 hover:bg-slate-100 relative group overflow-hidden">
            <input type="file" id="bukti" name="bukti" accept="image/*" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50">
            <div class="relative z-10 pointer-events-none">
                <p class="text-slate-500 group-hover:text-blue-600 transition-colors" id="file-name-display">Klik atau seret file gambar ke sini</p>
                <p class="text-sm text-slate-400 mt-1" id="file-format-display">Format: JPG, PNG, JPEG</p>
            </div>
        </div>
      </div>

      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-md transition-colors mt-4">
        Kirim Bukti Pembayaran
      </button>
    </form>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const metodeSelect = document.getElementById('metode_bayar');
    const qrisPreview = document.getElementById('qris-preview');
    const transferInfo = document.getElementById('transfer-info');

    function toggleInfo() {
        if (metodeSelect.value === 'qris') {
            qrisPreview.classList.remove('hidden');
            transferInfo.classList.add('hidden');
        } else if (metodeSelect.value === 'transfer') {
            transferInfo.classList.remove('hidden');
            qrisPreview.classList.add('hidden');
        } else {
            qrisPreview.classList.add('hidden');
            transferInfo.classList.add('hidden');
        }
    }

    metodeSelect.addEventListener('change', toggleInfo);
    // Jalankan sekali saat load (jika user kena validasi/kembali ke halaman ini)
    toggleInfo();

    // Tampilkan nama file saat gambar dipilih
    const fileInput = document.getElementById('bukti');
    const fileNameDisplay = document.getElementById('file-name-display');
    const fileFormatDisplay = document.getElementById('file-format-display');

    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files.length > 0) {
                fileNameDisplay.textContent = 'File terpilih: ' + this.files[0].name;
                fileNameDisplay.classList.replace('text-slate-500', 'text-blue-700');
                fileNameDisplay.classList.add('font-semibold');
                fileFormatDisplay.textContent = 'Siap untuk diupload';
                fileFormatDisplay.classList.replace('text-slate-400', 'text-blue-500');
            } else {
                fileNameDisplay.textContent = 'Klik atau seret file gambar ke sini';
                fileNameDisplay.classList.replace('text-blue-700', 'text-slate-500');
                fileNameDisplay.classList.remove('font-semibold');
                fileFormatDisplay.textContent = 'Format: JPG, PNG, JPEG';
                fileFormatDisplay.classList.replace('text-blue-500', 'text-slate-400');
            }
        });
    }
});
</script>
@endsection
