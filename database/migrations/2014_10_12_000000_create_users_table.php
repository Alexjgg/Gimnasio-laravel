<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Tabla de Usuarios
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role')->default('user');
            $table->string('password');
            $table->unsignedBigInteger('coach_id')->nullable();
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('coach_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('cascade');

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
