@extends('layouts.app')

@section('title', 'Daftar Kelas')

@section('content')
<section class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">📚 Daftar Kelas Baru</h2>

    <form action="{{ route('students.pendaftaran.store') }}" method="POST">
        @csrf

        <!-- Jenjang -->
        <div class="mb-4">
            <label class="block font-semibold">Jenjang</label>
            <select name="jenjang" id="jenjang" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Jenjang --</option>
                <optgroup label="SD">
                    <option value="sd1">SD 1</option>
                    <option value="sd2">SD 2</option>
                    <option value="sd3">SD 3</option>
                    <option value="sd4">SD 4</option>
                    <option value="sd5">SD 5</option>
                    <option value="sd6">SD 6</option>
                </optgroup>
                <optgroup label="SMP">
                    <option value="smp1">SMP 1</option>
                    <option value="smp2">SMP 2</option>
                    <option value="smp3">SMP 3</option>
                </optgroup>
                <optgroup label="SMA">
                    <option value="sma1">SMA 1</option>
                    <option value="sma2">SMA 2</option>
                    <option value="sma3">SMA 3</option>
                </optgroup>
            </select>
        </div>

        <!-- Mapel -->
        <div class="mb-4">
            <label class="block font-semibold">Mata Pelajaran</label>
            <select name="mapel_id" id="mapel" class="w-full border p-2 rounded" required>
                @foreach ($mapel as $m)
                    <option value="{{ $m->mapel_id }}">{{ $m->nama_mapel }}</option>
                @endforeach
            </select>
        </div>

        <!-- Periode -->
        <div class="mb-4">
            <label class="block font-semibold">Periode Program</label>
            <select name="durasi" id="periode" class="w-full border p-2 rounded" required>
                <option value="1">1 Bulan</option>
                <option value="3">3 Bulan</option>
                <option value="6">6 Bulan</option>
            </select>
        </div>

        <!-- Sesi -->
        <div class="mb-4">
            <label class="block font-semibold">Sesi</label>
            <select name="jadwal_id" id="sesi" class="w-full border p-2 rounded" required>
                @foreach ($jadwal as $j)
                    <option value="{{ $j->jadwal_id }}">{{ $j->hari }} - Sesi {{ $j->sesi }}</option>
                @endforeach
            </select>
        </div>

        <!-- Harga -->
        <div class="mb-4">
            <p class="font-semibold">Total Harga</p>
            <h3 id="harga-text" class="text-xl font-bold">Rp. 0 /Program</h3>
        </div>

        <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded">Daftar Kelas</button>
    </form>
</section>

<script>
    function updateHarga() {
        let jenjang = document.getElementById("jenjang").value;
        let mapel = document.getElementById("mapel").value;
        let sesi = document.getElementById("sesi").value;
        let periode = parseInt(document.getElementById("periode").value) || 1;

        if (jenjang && mapel && sesi) {
            fetch(`/students/kelas/get-harga?jenjang=${jenjang}&mapel_id=${mapel}&jadwal_id=${sesi}`)
            console.log(data);
                .then(res => res.json())
                .then(data => {
                    let harga = data.harga || 0;
                    let total = harga * periode;
                    document.getElementById("harga-text").innerText = "Rp. " + total.toLocaleString() + " /Program";
                });
        }
    }

    ["jenjang","mapel","sesi","periode"].forEach(id =>
        document.getElementById(id).addEventListener("change", updateHarga)
    );
</script>
@endsection