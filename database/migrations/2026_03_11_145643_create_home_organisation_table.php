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
        Schema::create('home_organisation', function (Blueprint $table) {
            $table->foreignUlid('organisation_id')->constrained('organisations', 'id')->onDelete('restrict');
            $table->foreignUlid('home_id')->constrained('homes', 'id')->onDelete('restrict');
            $table->primary(['organisation_id', 'home_id']);
            $table->timestamp('started_at')->index();
            $table->timestamp('ended_at')->nullable();
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
        Schema::dropIfExists('home_organisation');
    }
};
