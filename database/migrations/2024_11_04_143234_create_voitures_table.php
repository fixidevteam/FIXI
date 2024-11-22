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
        Schema::create('voitures', function (Blueprint $table) {
            $table->id();
            $table->string("numero_immatriculation");
            $table->string("marque");
            $table->string("modele");
            $table->string("photo")->nullable();
            $table->date("date_de_première_mise_en_circulation")->nullable();
            $table->date("date_achat")->nullable();
            $table->date("date_de_dédouanement")->nullable();
            $table->foreignId('user_id')->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voitures');
    }
};