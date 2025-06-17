<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelamarTable extends Migration
{
    public function up()
    {
        Schema::create('pelamar', function (Blueprint $table) {
            $table->id(); // This creates an auto-incrementing primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('photo_path')->nullable();
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('telepon');
            $table->text('alamat');
            $table->string('pendidikan_terakhir');
            $table->string('jurusan');
            $table->string('universitas');
            $table->year('tahun_lulus'); // Changed to year type instead of integer
            $table->string('cv_path');
            $table->text('pengalaman_kerja')->nullable();
            $table->text('skill')->nullable();
            $table->timestamps(); // This creates both created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelamar');
    }
}