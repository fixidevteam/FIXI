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
        Schema::create('user_papiers', function (Blueprint $table) {
            $table->id();
            $table->string("type");
            $table->string("photo")->nullable();
            $table->string("note")->nullable();
            $table->date("date_debut");
            $table->date("date_fin");
            $table->foreignId("user_id")->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_papiers');
    }
};
