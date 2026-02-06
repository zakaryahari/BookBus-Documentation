<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('segments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programme_id')->constrained('programmes')->onDelete('cascade');
            $table->foreignId('depart_etape_id')->constrained('etapes')->onDelete('cascade');
            $table->foreignId('arrive_etape_id')->constrained('etapes')->onDelete('cascade');
            $table->decimal('tarif', 8, 2);
            $table->float('distance_km');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('segments');
    }
};