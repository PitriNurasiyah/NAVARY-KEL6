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
        Schema::create('biodata_sapi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sapi')->unique();
            $table->string('nama');
            $table->string('jenis');
            $table->integer('umur')->default(0);
            $table->string('status_kesehatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata_sapi');
    }
};
