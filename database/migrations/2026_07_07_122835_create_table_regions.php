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
        Schema::create('regions', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('organisation_id')->constrained('organisations', 'id')->onDelete('restrict');
            $table->string('name', length:100);
            $table->foreignId('created_by_user_id')->constrained('users', 'id')->onDelete('restrict');
            $table->foreignId('updated_by_user_id')->nullable()->constrained('users', 'id')->onDelete('restrict');
            $table->unique(['organisation_id', 'name']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
