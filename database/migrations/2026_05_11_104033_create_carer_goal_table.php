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
        Schema::create('goal_user', function (Blueprint $table) {
            $table->foreignUlid('goal_id')->constrained('goals')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->primary(['goal_id', 'user_id']);
            $table->foreignId('assigned_by_user_id')->constrained('users')->onDelete('restrict');
            $table->timestamp('assigned_at');
            $table->foreignId('ended_by_user_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->timestamp('ended_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goal_user');
    }
};
