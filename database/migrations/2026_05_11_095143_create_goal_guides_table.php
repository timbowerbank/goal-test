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
        Schema::create('goal_guides', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('goal_id')->constrained('goals')->onDelete('restrict');
            $table->foreignId('created_by_user_id')->constrained('users')->onDelete('restrict');
            $table->string('title', length:40);
            $table->text('description');
            $table->string('file_path', length:200);
            $table->string('mime_type', length: 100);
            $table->unsignedTinyInteger('sort_order');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goal_guides');
    }
};
