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
        Schema::create('clients', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignId('user_id')->unique()->constrained('users', 'id')->onDelete('restrict');
            $table->foreignUlid('home_id')->constrained('homes', 'id')->onDelete('restrict');
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by_user_id')->nullable()->constrained('users', 'id')->onDelete('restrict');
            $table->string('client_status', length:20)->default('unverified')->index();
            $table->timestamp('client_status_updated_at')->nullable();
            $table->foreignId('client_status_updated_by_user_id')->nullable()->constrained('users', 'id')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
