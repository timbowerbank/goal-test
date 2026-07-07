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
        Schema::create('region_regional_operator', function (Blueprint $table) {
            $table->foreignUlid('region_id')->constrained('regions', 'id')->onDelete('restrict');
            $table->foreignUlid('regional_operator_id')->constrained('regional_operators', 'id')->onDelete('restrict');
            $table->primary(['regional_operator_id', 'region_id']);
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
        Schema::dropIfExists('region_regional_operator');
    }
};
