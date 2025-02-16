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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->dateTime('waktu');
            $table->dateTime('batas_waktu')->nullable();
            $table->bigInteger('total');
            $table->longText('bukti_bayar')->nullable();
            $table->string('no_resi')->unique();
            $table->bigInteger('uang_dibayar')->nullable();
            $table->bigInteger('kembalian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
