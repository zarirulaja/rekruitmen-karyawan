<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE lamaran MODIFY COLUMN status ENUM('pending', 'review', 'diterima', 'ditolak', 'wawancara') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Get all records with status 'review' and set them to 'pending' before removing the status
        \DB::table('lamaran')
            ->where('status', 'review')
            ->update(['status' => 'pending']);
            
        // Revert the enum to the original values
        \DB::statement("ALTER TABLE lamaran MODIFY COLUMN status ENUM('pending', 'diterima', 'ditolak', 'wawancara') NOT NULL DEFAULT 'pending'");
    }
};
