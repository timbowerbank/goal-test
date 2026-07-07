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
        Schema::create('organisation_reporters', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignId('user_id')->unique()->constrained('users', 'id')->onDelete('restrict');
            $table->foreignUlid('organisation_id')->constrained('organisations', 'id')->onDelete('restrict');
            $table->boolean('is_verified')->default(false);
            $table->foreignId('verified_by_user_id')->nullable()->constrained('users', 'id')->onDelete('restrict');
            $table->timestamp('verified_at')->nullable();
            $table->string('org_reporter_status', length:20)->default('unverified')->index();
            $table->timestamp('org_reporter_status_updated_at')->nullable();
            $table->foreignId('org_reporter_status_updated_by_user_id')->nullable()->constrained(table: 'users', indexName: 'org_reporter_status_upd_by_fk')->onDelete('restrict');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisation_reporters');
    }
};
