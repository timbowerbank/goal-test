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
        Schema::table('home_manager', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['home_id']);
            $table->dropPrimary(['user_id', 'home_id']);

            $table->dropColumn('user_id');

            // add the new manager_id column
            $table->foreignUlid('manager_id')->constrained('managers', 'id')->onDelete('restrict');
            $table->primary(['manager_id', 'home_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_manager', function (Blueprint $table) {
            // reverse everything
            $table->dropForeign(['manager_id']);
            $table->dropForeign(['home_id']);
            $table->dropPrimary(['manager_id', 'home_id']);
            $table->dropColumn('manager_id');

            // restore the original user_id and home_id columns
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('restrict');
            $table->foreignUlid('home_id')->constrained('homes', 'id')->onDelete('restrict');

            // restore the primary
            $table->primary(['user_id', 'home_id']);
        });
    }
};
