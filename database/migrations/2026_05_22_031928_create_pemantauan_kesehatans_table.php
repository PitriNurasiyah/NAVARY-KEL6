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
        Schema::create('pemantauan_kesehatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sapi_id')->constrained('biodata_sapi')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('kondisi_sekarang');
            $table->string('tindakan_perawatan')->nullable();
            $table->text('catatan_perkembangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemantauan_kesehatans');
    }
};
