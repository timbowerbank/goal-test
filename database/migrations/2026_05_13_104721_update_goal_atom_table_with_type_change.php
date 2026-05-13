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
        Schema::table('goal_atoms', function(Blueprint $table){
            $table->unsignedTinyInteger('frequency_value')->change();
            $table->string('frequency_type', 30)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('goal_atoms', function(Blueprint $table){
            $table->string('frequency_value', length:10);
            $table->string('frequency_type', 10)->change();
        });
    }
};
