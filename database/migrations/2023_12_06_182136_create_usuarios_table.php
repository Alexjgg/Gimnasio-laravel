<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('datosusuario', function (Blueprint $table) {
            $table->id('idDatosUsuario');
            $table->string('email')->unique();
            $table->string('nombre');
            $table->string('pass');
            $table->string('rol')->nullable();
            $table->timestamps();
        });

        Schema::create('admin', function (Blueprint $table) {
            $table->id('idAdmin');
            $table->foreignId('idAdmin')->constrained('datosusuario')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('entrenador', function (Blueprint $table) {
            $table->id('idEntrenador');
            $table->foreignId('idEntrenador')->constrained('datosusuario')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('cliente', function (Blueprint $table) {
            $table->id('idCliente');
            $table->foreignId('idCliente')->constrained('datosusuario')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('idEntrenador')->nullable()->constrained('entrenador')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('entrenamiento', function (Blueprint $table) {
            $table->id('idEntrenamiento');
            $table->string('dia')->nullable();
            $table->string('nombre');
            $table->foreignId('entrenador')->constrained('entrenador')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('cliente_has_entrenamientos', function (Blueprint $table) {
            $table->foreignId('idCliente')->constrained('cliente')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('idEntrenamiento')->constrained('entrenamiento')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['idCliente', 'idEntrenamiento']);
        });

        Schema::create('ejercicio', function (Blueprint $table) {
            $table->id('idEjercicio');
            $table->string('nombre')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('repeticiones')->nullable();
            $table->string('duracion')->nullable();
            $table->timestamps();
        });

        Schema::create('ejercicios_has_entrenamientos', function (Blueprint $table) {
            $table->foreignId('idEjercicios')->constrained('ejercicio')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('idEntrenamiento')->constrained('entrenamiento')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['idEjercicios', 'idEntrenamiento']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('datosusuario');
        Schema::dropIfExists('admin');
        Schema::dropIfExists('entrenador');
        Schema::dropIfExists('cliente');
        Schema::dropIfExists('entrenamiento');
        Schema::dropIfExists('cliente_has_entrenamientos');
        Schema::dropIfExists('ejercicio');
        Schema::dropIfExists('ejercicios_has_entrenamientos');
    }
};
