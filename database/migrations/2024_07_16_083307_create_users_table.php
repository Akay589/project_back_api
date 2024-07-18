<?php

use App\Models\Role;
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
        Schema::create('users', function (Blueprint $table) {
            $table->string('Login')->primary();
            $table->string('mdp');
            $table->string('nomU');
            $table->integer('telU');
            $table->string('mailU');
            $table->unsignedBigInteger('role_id');
            $table->string('AdresseConstruction');

              // Foreign keys
              $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
