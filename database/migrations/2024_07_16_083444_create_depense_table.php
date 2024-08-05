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
        Schema::create('depense', function (Blueprint $table) {
            $table->unsignedInteger('NumD');
            $table->string('CodeM');

            $table->string('status');
            $table->date('DateF');
            $table->timestamps();

            // Primary key composite
            $table->primary(['NumD', 'CodeM']);

            // Foreign keys
            $table->foreign('NumD')->references('NumD')->on('devis')->onDelete('cascade');
            $table->foreign('CodeM')->references('CodeM')->on('materiels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depense');
    }
};
