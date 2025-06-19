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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('normal_user_id')->references('id')->on('normal_users')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('trader_id')->references('id')->on('traders')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->boolean('is_blocked')->default(false)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
