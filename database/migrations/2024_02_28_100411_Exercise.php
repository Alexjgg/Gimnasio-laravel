<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * tabla de Ejercicios
     * Run the migrations.
     */
    public function up(): void
    {   
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('description');
            $table->string('repetitions');
            $table->string('duration');
            $table->rememberToken();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations. 
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('exercises');
    }
};
