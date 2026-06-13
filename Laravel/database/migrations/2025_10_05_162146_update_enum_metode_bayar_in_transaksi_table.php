<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah enum supaya bisa menampung 'transfer', 'qris', dan 'ewallet'
        DB::statement("ALTER TABLE transaksi MODIFY COLUMN metode_bayar ENUM('transfer', 'qris', 'ewallet') NOT NULL DEFAULT 'transfer'");
    }

    public function down(): void
    {
        // Kembalikan ke definisi semula (transfer dan qris saja)
        DB::statement("ALTER TABLE transaksi MODIFY COLUMN metode_bayar ENUM('transfer', 'qris') NOT NULL DEFAULT 'transfer'");
    }
};