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
        Schema::create('activity_type_goal', function (Blueprint $table) {
            $table->foreignUlid('goal_id')->constrained('goals')->onDelete('restrict');
            $table->foreignUlid('activity_type_id')->constrained('activity_types')->onDelete('restrict');
            $table->primary(['goal_id', 'activity_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_type_goal');
    }
};
