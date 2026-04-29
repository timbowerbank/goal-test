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
        Schema::table('organisation_administrators', function(Blueprint $table){
            $table->string('administrator_status', 20)->default('unverified')->index();
            $table->timestamp('status_updated_at')->nullable();
            $table->foreignId('status_updated_by_user_id')->nullable()->constrained('users', 'id')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organisation_administrators', function(Blueprint $table){
            $table->dropForeign('status_updated_by_user_id');
            $table->dropIndex('administrator_status');
            $table->dropColumn([
                'administrator_status',
                'status_updated_at',
                'status_updated_by_user_id',
            ]);
            
        });
    }
};
