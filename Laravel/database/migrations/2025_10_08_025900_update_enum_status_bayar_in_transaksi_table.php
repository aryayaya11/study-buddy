<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah enum status_bayar untuk menambahkan 'menunggu_verifikasi'
        DB::statement("ALTER TABLE transaksi MODIFY COLUMN status_bayar ENUM('pending', 'paid', 'failed', 'menunggu_verifikasi') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke definisi semula
        DB::statement("ALTER TABLE transaksi MODIFY COLUMN status_bayar ENUM('pending', 'paid', 'failed') NOT NULL DEFAULT 'pending'");
    }
};
