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
        Schema::create('goal_tasks', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('goal_id')->constrained('goals')->onDelete('restrict');
            $table->string('title', length:40);
            $table->text('description');
            $table->string('priority', length:20)->index();
            $table->foreignId('assigned_to_user_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->timestamp('due_at')->index();
            $table->timestamp('completed_at')->nullable()->index();
            $table->foreignId('completed_with_user_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->timestamp('archived_at')->nullable();
            $table->foreignId('archived_by_user_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->string('goal_task_status', length:20)->default('not started')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goal_tasks');
    }
};
