<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, modify the column to be a string type instead of enum
        Schema::table('lamaran', function (Blueprint $table) {
            // Change the status column from enum to string
            DB::statement('ALTER TABLE lamaran MODIFY status VARCHAR(20) NOT NULL DEFAULT "pending"');
        });
        
        // Update any existing records with invalid status values
        DB::statement('UPDATE lamaran SET status = "pending" WHERE status NOT IN ("pending", "review", "wawancara", "diterima", "ditolak")');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to the original enum type
        Schema::table('lamaran', function (Blueprint $table) {
            DB::statement('ALTER TABLE lamaran MODIFY status ENUM("pending", "review", "wawancara", "diterima", "ditolak") NOT NULL DEFAULT "pending"');
        });
    }
};
