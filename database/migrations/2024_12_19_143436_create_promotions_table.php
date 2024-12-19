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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('nom_promotion');
            $table->string('ville'); // City name
            $table->date('date_debut'); // Start date
            $table->date('date_fin'); // End date
            $table->string('lien_promotion'); // Promotion link
            $table->unsignedBigInteger('garage_id'); // Foreign key for garage
            $table->foreign('garage_id')->references('id')->on('garages')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};