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
        Schema::table('carer_home', function (Blueprint $table) {
            // home_id column already exists, just add the foreign key constraint
            $table->foreign('home_id')->references('id')->on('homes')->onDelete('restrict');
            
            // add primary key and index
            $table->primary(['carer_id', 'home_id']);
            $table->index('home_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carer_home', function (Blueprint $table) {
            $table->dropForeign(['carer_id']);
            $table->dropForeign(['home_id']);
            $table->dropPrimary(['carer_id', 'home_id']);
            $table->dropIndex(['home_id']);
            $table->dropColumn('carer_id');
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('restrict');
            $table->foreignUlid('home_id')->constrained('homes', 'id')->onDelete('restrict');
            $table->primary(['user_id', 'home_id']);
            $table->index('home_id');
        });
    }
};
