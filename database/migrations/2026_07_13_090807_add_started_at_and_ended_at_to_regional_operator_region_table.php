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
        Schema::table('region_regional_operator', function (Blueprint $table) {
            $table->timestamp('started_at')->index();
            $table->timestamp('ended_at')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('region_regional_operator', function (Blueprint $table) {
            $table->dropIndex(['started_at']);
            $table->dropIndex(['ended_at']);
            $table->dropColumn('started_at');
            $table->dropColumn('ended_at');
        });
    }
};
