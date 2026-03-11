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
        Schema::create('organisations', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('organisation_name', length:100)->index();
            $table->string('address_1', length: 100);
            $table->string('address_2', length: 100)->nullable();
            $table->string('city', length: 100);
            $table->string('postcode', length: 100);
            $table->string('telephone', length: 100);
            $table->string('website_url', length: 100)->nullable();
            $table->foreignId('created_by_user_id')->constrained('users', 'id')->onDelete('restrict');
            $table->string('organisation_status', length: 20);
            $table->foreignId('updated_by_user_id')->nullable()->constrained('users', 'id')->onDelete('restrict');
            $table->timestamps();
            $table->index('created_at');
            $table->softDeletes()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisations');
    }
};
