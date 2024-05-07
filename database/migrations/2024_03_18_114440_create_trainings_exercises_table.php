<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Tabla que releciona los Ejercicios que tiene un entrenamiento
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('training_exercise', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_id');
            $table->unsignedBigInteger('exercise_id');
            $table->timestamps();

            $table->unique(['training_id', 'exercise_id']); // Garantiza que no haya duplicados de ejercicios dentro de un mismo entrenamiento

            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade');
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_exercise');
    }
};
