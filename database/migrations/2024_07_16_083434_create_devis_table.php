<?php

use App\Models\User;
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
        Schema::create('devis', function (Blueprint $table) {
            $table->unsignedInteger('NumD')->primary();

            $table->date('DateDv');
            $table->foreignIdFor(User::class);
            $table->string('CodeO');
            $table->integer('PrixU');
            $table->string('CodeUnit');
            $table->integer('Quantité');
            $table->integer('Montant');

            $table->timestamps();


            // Foreign keys

            $table->foreign('CodeO')->references('CodeO')->on('ouvriers')->onDelete('cascade');
            $table->foreign('CodeUnit')->references('CodeUnit')->on('unites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devis');
    }
};
