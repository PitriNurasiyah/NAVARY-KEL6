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
        Schema::create('produksi_susu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sapi_id')->constrained('biodata_sapi')->onDelete('cascade');
            $table->date('tanggal');
            $table->decimal('jumlah_pagi', 10, 2)->default(0);
            $table->decimal('jumlah_sore', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produksi_susu');
    }
};
