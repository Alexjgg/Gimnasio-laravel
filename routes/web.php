<?php

use App\Http\Controllers\ExerciseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TrainingController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('Login');
Route::post('/login', [LoginController::class, 'login'])->name('Login');
Route::post('/logaut', [LoginController::class, 'logout'])->name('Logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('Register');
Route::post('/register', [RegisterController::class, 'register'])->name('Register');

Route::get('/usuers/{id}/edit', [RegisterController::class, 'edit'])->name('Users.edit');

Route::put('/usuers/{id}', [RegisterController::class, 'update'])->name('Users.update');


Route::get('/users/index', [RegisterController::class, 'index'])->name('Users.index');
//Exercises Rutas

Route::get('/exercises/index', [ExerciseController::class, 'index'])->name('Exercises.index');

Route::get('/exercises/new', [ExerciseController::class, 'create'])->name('Exercises.create');
Route::post('/exercises/new', [ExerciseController::class, 'store'])->name('Exercises.store');


Route::get('/exercises/{id}', [ExerciseController::class, 'edit'])->name('Exercises.edit');
Route::post('/exercises/{id}', [ExerciseController::class, 'update'])->name('Exercises.update');

route::delete('/exercises/{id}', [ExerciseController::class, 'destroy'])->name('Exercises.destroy');

//Entrenadores Rutas
Route::get('/clientes', [RegisterController::class, 'upClients'])->name('Clientes');


//Entrenamientos rutas
Route::get('/Trainings/index', [TrainingController::class, 'index'])->name('Trainings.index');

Route::get('/Trainings/new', [TrainingController::class, 'new'])->name('Trainings.New');