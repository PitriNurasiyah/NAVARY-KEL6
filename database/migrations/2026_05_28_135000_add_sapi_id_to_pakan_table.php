<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pakan', function (Blueprint $table) {
            $table->unsignedBigInteger('sapi_id')->nullable()->after('id');
            $table->foreign('sapi_id')->references('id')->on('biodata_sapi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('pakan', function (Blueprint $table) {
            $table->dropForeign(['sapi_id']);
            $table->dropColumn('sapi_id');
        });
    }
};
