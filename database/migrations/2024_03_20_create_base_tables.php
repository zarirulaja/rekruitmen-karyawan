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
        // Create pelamar table
        Schema::create('pelamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->text('pengalaman_kerja')->nullable();
            $table->text('keahlian')->nullable();
            $table->string('cv_path')->nullable();
            $table->timestamps();
        });

        // Create lowongan table
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('posisi');
            $table->string('tipe_pekerjaan');
            $table->string('lokasi');
            $table->text('persyaratan');
            $table->text('tanggung_jawab');
            $table->decimal('gaji_min', 12, 2)->nullable();
            $table->decimal('gaji_max', 12, 2)->nullable();
            $table->boolean('status')->default(true); // true = active, false = closed
            $table->date('tanggal_tutup');
            $table->timestamps();
        });

        // Create lamaran table
        Schema::create('lamaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelamar_id')->constrained()->onDelete('cascade');
            $table->foreignId('lowongan_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'review', 'wawancara', 'diterima', 'ditolak'])->default('pending');
            $table->text('catatan_hrd')->nullable();
            $table->date('tanggal_lamar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamaran');
        Schema::dropIfExists('lowongan');
        Schema::dropIfExists('pelamar');
    }
}; 