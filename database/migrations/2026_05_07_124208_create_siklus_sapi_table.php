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
        Schema::create('siklus_sapi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sapi_id')->constrained('biodata_sapi')->onDelete('cascade');
            $table->string('fase'); // IB, Bunting, Melahirkan, Laktasi, Kering Kandang
            $table->date('tanggal_mulai');
            $table->date('estimasi_selesai')->nullable();
            $table->integer('hari_ke')->default(0);
            $table->string('status')->default('Berjalan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siklus_sapi');
    }
};
