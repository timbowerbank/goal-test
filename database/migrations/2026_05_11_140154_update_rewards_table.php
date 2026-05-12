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
        
        Schema::table('goals', function(Blueprint $table){
            $table->dropForeign(['reward_id']);
            $table->dropColumn('reward_id');
            });

        Schema::table('rewards', function(Blueprint $table){
            $table->foreignUlid('goal_id')->constrained('goals')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rewards', function(Blueprint $table){
            $table->dropForeign(['goal_id']);
            $table->dropColumn('goal_id');
        });

        Schema::table('goals', function(Blueprint $table){
            $table->foreignUlid('reward_id')->nullable()->constrained('rewards')->onDelete('restrict');
        });
    }
};
