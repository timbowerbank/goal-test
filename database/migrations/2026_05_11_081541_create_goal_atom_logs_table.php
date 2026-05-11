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
        Schema::create('goal_atom_logs', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('goal_atom_id')->constrained('goal_atoms')->onDelete('restrict');
            $table->timestamp('completed_at');
            $table->foreignId('assisted_by_user_id')->constrained('users')->onDelete('restrict');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goal_atom_logs');
    }
};
