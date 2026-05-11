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
        Schema::create('goal_task_events', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('goal_task_id')->constrained('goal_tasks')->onDelete('restrict');
            $table->string('event_type', length:20);
            $table->json('old_value')->nullable();
            $table->json('new_value')->nullable();
            $table->foreignId('performed_by_user_id')->constrained('users')->onDelete('restrict');
            $table->timestamp('performed_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goal_task_events');
    }
};
