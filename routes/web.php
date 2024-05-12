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


Route::get('/users/index', [RegisterController::class, 'index'])->name('Users.index');
Route::delete('/users/{id}', [RegisterController::class, 'destroy'])->name('Users.destroy');

Route::get('/users/{id}', [RegisterController::class, 'edit'])->name('Users.edit');
Route::put('/users/{id}', [RegisterController::class, 'update'])->name('Users.update');

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
Route::get('/trainings/index', [TrainingController::class, 'index'])->name('Trainings.index');

Route::get('/trainings/new', [TrainingController::class, 'new'])->name('Trainings.new');
Route::post('/trainings/new', [TrainingController::class, 'store'])->name('Trainings.store');

Route::get('/trainings/{id}', [TrainingController::class, 'edit'])->name('Trainings.edit');
Route::post('/trainings/{id}', [TrainingController::class, 'store'])->name('Trainings.update');

route::delete('/trainings/{id}', [TrainingController::class, 'destroy'])->name('Trainings.destroy');