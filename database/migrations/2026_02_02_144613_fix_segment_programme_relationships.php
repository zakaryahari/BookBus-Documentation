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
        // Drop existing foreign keys and columns
        Schema::table('segments', function (Blueprint $table) {
            $table->dropForeign(['programme_id']);
            $table->dropColumn('programme_id');
        });

        Schema::table('programmes', function (Blueprint $table) {
            $table->dropForeign(['route_id']);
            $table->dropColumn('route_id');
        });

        // Add correct relationships
        Schema::table('segments', function (Blueprint $table) {
            $table->foreignId('route_id')->constrained('routes')->onDelete('cascade');
        });

        Schema::table('programmes', function (Blueprint $table) {
            $table->foreignId('segment_id')->constrained('segments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse the changes
        Schema::table('programmes', function (Blueprint $table) {
            $table->dropForeign(['segment_id']);
            $table->dropColumn('segment_id');
        });

        Schema::table('segments', function (Blueprint $table) {
            $table->dropForeign(['route_id']);
            $table->dropColumn('route_id');
        });

        Schema::table('programmes', function (Blueprint $table) {
            $table->foreignId('route_id')->constrained('routes')->onDelete('cascade');
        });

        Schema::table('segments', function (Blueprint $table) {
            $table->foreignId('programme_id')->constrained('programmes')->onDelete('cascade');
        });
    }
};