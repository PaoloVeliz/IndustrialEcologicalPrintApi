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
        Schema::create('electrical_energies', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->float('amount',8,2);
            $table->string('responsable_team');
            $table->date('date');
            $table->text('emission_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electrical_energies');
    }
};
