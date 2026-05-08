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
        Schema::create('goals', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignId('created_by_user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('updated_by_user_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->string('goal_type', length:20)->index();
            $table->unsignedSmallInteger('goal_total_cost')->nullable();
            $table->string('title', length:40)->index();
            $table->string('image_url', length:200)->nullable();
            $table->text('description');
            $table->string('video_url', length:200)->nullable();
            $table->unsignedTinyInteger('status_percent')->default(0);
            $table->foreignId('client_user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('lead_user_id')->constrained('users')->onDelete('restrict');
            $table->foreignUlid('home_id')->constrained('homes')->onDelete('restrict');
            $table->foreignUlid('organisation_id')->constrained('organisations')->onDelete('restrict');
            $table->timestamp('achieve_by')->nullable()->index();
            $table->timestamp('goal_completed_at')->nullable();
            $table->foreignId('goal_completed_with_user_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->foreignUlid('reward_id')->nullable()->constrained('rewards')->onDelete('restrict');
            $table->string('goal_status', length:20)->default('draft')->index();
            $table->timestamp('archived_at')->nullable();
            $table->foreignId('archived_by_user_id')->nullable()->constrained('users')->onDelete('restrict');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
