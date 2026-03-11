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
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn('name');
            $table->string('first_name', length: 100)->index();
            $table->string('surname', length: 100)->index();
            $table->string('avatar_url', length: 200)->nullable();
            $table->index(['first_name', 'surname'], 'users_full_name_index');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropIndex('users_full_name_index');
            $table->dropIndex(['first_name']);
            $table->dropIndex(['surname']);
            $table->dropColumn(['first_name', 'surname', 'avatar_url']);
            $table->string('name', length:255);
        });
    }
};
