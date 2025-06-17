<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLowonganTable extends Migration
{
    public function up()
    {
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
            $table->boolean('status')->default(true);
            $table->date('tanggal_tutup');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('lowongan');
    }
}