# LAPORAN PROJECT BASIS DATA

## 1. Identitas Kelompok

**Kelompok**: 4  

**Judul Project**:  
**STUDY BUDDY: Website Aplikasi Penyedia Jasa Tutor Privat Online Jenjang SD, SMP, dan SMA**

**Anggota Kelompok**:
1. Arfianti Fadilah Putri  
2. Reihan Maulana Alhaidar 
3. Shandika Maurifki Alhudi 
4. Arya Putra Permana 
5. Azka Saqila Rochman 

---

## 2. Deskripsi Singkat Project

Study Buddy merupakan sebuah aplikasi berbasis website yang dirancang untuk menyediakan layanan tutor privat secara online bagi siswa jenjang Sekolah Dasar (SD), Sekolah Menengah Pertama (SMP), dan Sekolah Menengah Atas (SMA). Aplikasi ini bertujuan untuk mempertemukan siswa dengan tutor yang sesuai berdasarkan mata pelajaran, jenjang pendidikan, dan ketersediaan waktu, sehingga proses belajar mengajar dapat berlangsung secara efektif, fleksibel, dan terstruktur.

Dalam pengembangannya, project ini berfokus pada perancangan basis data yang mampu mengelola data pengguna secara terintegrasi, meliputi data siswa, tutor, mata pelajaran, kelas, pendaftaran, jadwal, serta transaksi pembayaran. Basis data dirancang untuk mendukung kebutuhan operasional aplikasi sekaligus memudahkan pengelolaan, pencarian, dan analisis data.

---

## 3. Tujuan

Tujuan dari project basis data Study Buddy adalah:

1. Merancang struktur basis data yang efisien dan terorganisir untuk mendukung sistem layanan tutor privat online.
2. Mengelola data siswa, tutor, mata pelajaran, kelas, dan transaksi secara konsisten dan terintegrasi.
3. Mendukung proses bisnis utama seperti pendaftaran kelas, penjadwalan, dan pencatatan pembayaran.
4. Menyediakan fondasi data yang dapat dikembangkan lebih lanjut untuk kebutuhan analisis dan pelaporan.

---

## 4. Ruang Lingkup Sistem

Ruang lingkup project ini mencakup:

1. Pengelolaan data pengguna (siswa dan tutor)
2. Pengelolaan data mata pelajaran berdasarkan jenjang SD, SMP, dan SMA
3. Pendaftaran siswa ke kelas atau sesi bimbingan
4. Penjadwalan kegiatan belajar
5. Pencatatan transaksi dan pendapatan

---

## 5. Teknologi yang Digunakan

1. Database Management System: MySQL
2. Bahasa Query: SQL
3. Tools Pendukung: Pentaho (untuk proses ETL dan pengolahan data lanjutan) dan Python/Laravel (Website)

---

## 6. Struktur Direktori Project

Project ini terdiri dari tiga komponen utama:
1. **[Database](file:///d:/KULIAH/Stubud%20Final/BasDat_Kelompok%204/Database)**: Berisi file SQL backup basis data (`Kelompok D_DB.sql`) yang bersih untuk di-import.
2. **[Laravel](file:///d:/KULIAH/Stubud%20Final/BasDat_Kelompok%204/Laravel)**: Source code aplikasi web utama menggunakan framework Laravel.
3. **[Pentaho](file:///d:/KULIAH/Stubud%20Final/BasDat_Kelompok%204/Pentaho)**: Berisi job (`etl_dw_sb.kjb`) dan file transformasi Pentaho (`.ktr`) untuk keperluan ETL (Extract, Transform, Load) ke data warehouse.

---

## 7. Panduan Setup & Instalasi

### A. Konfigurasi Database (MySQL)
1. Aktifkan **MySQL** melalui XAMPP atau DBMS lokal Anda.
2. Buka phpMyAdmin (atau client SQL favorit Anda) dan buat database baru bernama `studybuddy_uas_fix_fix_bgtt` (atau nama database lain sesuai keinginan Anda).
3. Import file database **[Kelompok D_DB.sql](file:///d:/KULIAH/Stubud%20Final/BasDat_Kelompok%204/Database/Kelompok%20D_DB.sql)** yang ada di dalam folder `Database`.

### B. Konfigurasi Website (Laravel)
1. Buka terminal di folder **[Laravel](file:///d:/KULIAH/Stubud%20Final/BasDat_Kelompok%204/Laravel)**.
2. Instal library PHP melalui Composer:
   ```bash
   composer install
   ```
3. Instal library front-end menggunakan NPM:
   ```bash
   npm install
   ```
4. Salin file `.env.example` menjadi `.env` jika belum ada, lalu sesuaikan koneksi database Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=studybuddy_uas_fix_fix_bgtt
   DB_USERNAME=root
   DB_PASSWORD=
   ```
5. Generate key Laravel:
   ```bash
   php artisan key:generate
   ```
6. Jalankan server Laravel:
   ```bash
   php artisan serve
   ```
7. Jalankan compiler asset front-end di terminal terpisah:
   ```bash
   npm run dev
   ```

### C. Menjalankan Job ETL (Pentaho)
1. Buka **Pentaho Data Integration (Spoon)**.
2. Buka file job **[etl_dw_sb.kjb](file:///d:/KULIAH/Stubud%20Final/BasDat_Kelompok%204/Pentaho/etl_dw_sb.kjb)** dari folder `Pentaho`.
3. Jalankan (Run) job tersebut. Seluruh file transformasi `.ktr` (seperti `dim_tutor_sb.ktr`, `dim_siswa_sb.ktr`, dll.) akan otomatis berjalan berurutan menggunakan folder relative path yang telah dioptimasi.

---

## 8. Penutup

Dengan adanya project Study Buddy, diharapkan sistem basis data yang dirancang mampu menjadi fondasi yang kuat bagi aplikasi layanan tutor privat online. Project ini dikembangkan sebagai bagian dari pembelajaran dan penerapan konsep basis data, serta dapat dijadikan referensi untuk pengembangan sistem informasi pendidikan di masa mendatang.

---


