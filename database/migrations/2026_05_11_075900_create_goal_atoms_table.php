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
        Schema::create('goal_atoms', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('goal_id')->constrained('goals')->onDelete('restrict');
            $table->string('title', length:40);
            $table->string('frequency_type', length:10);
            $table->string('frequency_value', length:10);
            $table->unsignedTinyInteger('total_required');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goal_atoms');
    }
};
