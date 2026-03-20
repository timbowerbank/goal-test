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
        Schema::table('client_family_friend', function (Blueprint $table) {
            $table->dropForeign(['client_user_id']);
            $table->dropForeign(['family_friend_user_id']);

            $table->dropPrimary(['client_user_id', 'family_friend_user_id']);

            $table->dropIndex(['family_friend_user_id']);

            $table->dropColumn(['client_user_id', 'family_friend_user_id']);

            // add new columns and indexes
            $table->foreignUlid('client_id')->constrained('clients', 'id')->onDelete('restrict');
            $table->foreignUlid('family_friend_id')->constrained('family_friends', 'id')->onDelete('restrict');

            $table->primary(['client_id', 'family_friend_id']);
            $table->index('family_friend_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_family_friend', function (Blueprint $table) {
            // reverse everything
            $table->dropForeign(['client_id']);
            $table->dropForeign(['family_friend_id']);

            $table->dropPrimary(['client_id', 'family_friend_id']);
            $table->dropIndex(['family_friend_id']);

            $table->dropColumn(['client_id', 'family_friend_id']);

            // restore original columns
            $table->foreignId('client_user_id')->constrained('clients', 'user_id')->onDelete('restrict');
            $table->foreignId('family_friend_user_id')->constrained('family_friends', 'user_id')->onDelete('restrict');

            // restore primary key and index
            $table->primary(['client_user_id', 'family_friend_user_id']);
            $table->index('family_friend_user_id');
        });
    }
};
