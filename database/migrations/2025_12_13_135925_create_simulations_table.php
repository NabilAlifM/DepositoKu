<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('simulations', function (Blueprint $table) {
            $table->id('simulasi_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('bank_id');
            $table->decimal('nominal_deposito', 15, 2);
            $table->integer('jangka_waktu_bulan');
            $table->decimal('bunga_diterima', 15, 2);
            $table->decimal('total_akhir', 15, 2);
            $table->timestamp('waktu_simulasi')->useCurrent();
            
            $table->foreign('bank_id')->references('bank_id')->on('banks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simulations');
    }
};