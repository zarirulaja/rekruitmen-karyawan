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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelamar_id')->constrained('pelamar')->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->string('type'); // 'lamaran', 'wawancara', 'lowongan'
            $table->text('data')->nullable(); // JSON data for additional info
            $table->boolean('is_read')->default(false);
            $table->foreignId('related_id')->nullable(); // Related entity ID (lowongan_id, lamaran_id, etc.)
            $table->string('related_type')->nullable(); // Related entity type (model name)
            $table->string('action_text')->nullable(); // Text for action button
            $table->string('action_url')->nullable(); // URL for action button
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
