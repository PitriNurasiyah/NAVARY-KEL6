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
        Schema::table('pakan', function (Blueprint $table) {
            $table->decimal('stok_awal', 10, 2)->default(0)->after('stok');
        });

        // Copy existing stok values to stok_awal for historical integrity
        \DB::table('pakan')->update([
            'stok_awal' => \DB::raw('stok')
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pakan', function (Blueprint $table) {
            $table->dropColumn('stok_awal');
        });
    }
};
