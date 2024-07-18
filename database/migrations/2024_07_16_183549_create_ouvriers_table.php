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
        Schema::create('ouvriers', function (Blueprint $table) {
            $table->string('CodeO')->primary();
            $table->string('NomO');
            $table->string('PrenO');
            $table->string('CodeF');
            $table->string('CIN')->unique();
            $table->integer('contact')->unique();

            //foreign KEY Constraint
            $table->foreign('CodeF')->references('CodeF')->on('fonctions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ouvriers');
    }
};
