<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLamaranTable extends Migration
{
    public function up()
    {
        Schema::create('lamaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelamar_id');
            $table->unsignedBigInteger('lowongan_id');
            $table->enum('status', ['pending', 'diterima', 'ditolak', 'wawancara'])->default('pending');
            $table->text('catatan_hrd')->nullable();
            $table->text('catatan_wawancara')->nullable(); // Added missing column
            $table->string('interviewer')->nullable(); // Added missing column
            $table->dateTime('jadwal_wawancara')->nullable(); // Added missing column
            $table->string('lokasi_wawancara')->nullable(); // Added missing column
            $table->date('tanggal_lamar');
            $table->text('pesan_tambahan')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('pelamar_id')->references('id')->on('pelamar')->onDelete('cascade');
            $table->foreign('lowongan_id')->references('id')->on('lowongan')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('lamaran', function (Blueprint $table) {
            $table->dropForeign(['pelamar_id']);
            $table->dropForeign(['lowongan_id']);
        });
        
        Schema::dropIfExists('lamaran');
    }
}