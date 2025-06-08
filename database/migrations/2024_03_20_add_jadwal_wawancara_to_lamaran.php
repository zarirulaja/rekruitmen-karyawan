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
        Schema::table('lamaran', function (Blueprint $table) {
            $table->dateTime('jadwal_wawancara')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lamaran', function (Blueprint $table) {
            $table->dropColumn('jadwal_wawancara');
        });
    }
}; 