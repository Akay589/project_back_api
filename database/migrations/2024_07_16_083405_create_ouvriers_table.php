<?php

use App\Models\Fonction;
use App\Models\Ouvrier;
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
            $table->integer('Contact')->unique();
            $table->timestamps();

              // Foreign keys
              $table->foreign('CodeF')->references('CodeF')->on('fonctions')->onDelete('cascade');
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
