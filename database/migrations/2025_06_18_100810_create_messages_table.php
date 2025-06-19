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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('chat_id')->nullable();
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->enum('sender_type', ['normal_user', 'trader'])->nullable();
            $table->text('message')->nullable();
            $table->boolean('is_read')->default(false)->nullable();
            $table->boolean('is_reported')->default(false)->nullable();
            $table->timestamps();

            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');
            $table->index(['sender_id', 'sender_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
