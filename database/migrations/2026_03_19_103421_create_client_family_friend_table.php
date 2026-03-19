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
        Schema::create('client_family_friend', function (Blueprint $table) {
            $table->foreignId('client_user_id')->constrained('clients', 'user_id')->onDelete('restrict');
            $table->foreignId('family_friend_user_id')->constrained('family_friends', 'user_id')->onDelete('restrict');
            $table->primary(['client_user_id', 'family_friend_user_id']);
            $table->index('family_friend_user_id');
            $table->timestamp('started_at');
            $table->timestamp('ended_at')->nullable();
            $table->foreignId('created_by_user_id')->constrained('users', 'id')->onDelete('restrict');
            $table->foreignId('updated_by_user_id')->nullable()->constrained('users', 'id')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_family_friend');
    }
};
