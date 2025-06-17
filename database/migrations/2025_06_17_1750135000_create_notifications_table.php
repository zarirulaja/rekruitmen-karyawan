<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('pelamar_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->string('type');
            $table->json('data')->nullable();
            $table->boolean('is_read')->default(false);
            $table->unsignedBigInteger('related_id')->nullable();
            $table->string('related_type')->nullable();
            $table->string('action_text')->nullable();
            $table->string('action_url')->nullable();
            $table->timestamps();

            $table->index(['related_id', 'related_type']);

        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}