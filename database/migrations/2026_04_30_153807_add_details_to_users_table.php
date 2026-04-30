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
        Schema::table('users', function (Blueprint $table) {
            // Check and add username if it doesn't exist
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->after('name')->unique()->nullable();
            }
            $table->string('role')->after('password')->default('Admin'); // Admin, Peternak, Penjualan
            $table->string('no_telepon')->after('role')->nullable();
            $table->string('status')->after('no_telepon')->default('Aktif'); // Aktif, Nonaktif
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'username')) {
                $table->dropColumn('username');
            }
            $table->dropColumn('role');
            $table->dropColumn('no_telepon');
            $table->dropColumn('status');
        });
    }
};
