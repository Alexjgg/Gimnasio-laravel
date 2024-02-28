<?php

use App\Http\Controllers\EjercicioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logaut', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/usuarios/{id}/editar', [RegisterController::class, 'edit'])->name('usuarios.editar');

Route::put('/usuarios/{id}', [RegisterController::class, 'update'])->name('usuarios.actualizar');

//Ejercicios Rutas

Route::get('/ejercicios/index', [EjercicioController::class, 'index'])->name('ejercicios.index');

Route::get('/ejercicios/new', [EjercicioController::class, 'create'])->name('ejercicios.create');
Route::post('/ejercicios/new', [EjercicioController::class, 'store'])->name('ejercicios.store');


Route::get('/ejercicios/{id}', [EjercicioController::class, 'edit'])->name('ejercicios.edit');
Route::post('/ejercicios/{id}', [EjercicioController::class, 'update'])->name('ejercicios.update');

route::delete('/ejercicios/{id}', [EjercicioController::class, 'destroy'])->name('ejercicios.destroy');