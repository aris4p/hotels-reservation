<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('notrx')->unique();
            $table->unsignedBigInteger('pelanggan_id');
            $table->unsignedBigInteger('kamar_id');
            $table->decimal('harga', 10, 2);
            $table->integer('jumlah');
            $table->date('tglCheckin');
            $table->date('tglCheckout');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
