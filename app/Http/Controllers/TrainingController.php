<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ejercicio;
use App\Models\Training;

class TrainingController extends Controller
{
    public function index()
    {

        $Training = Training::all();

        return view('Training.index', ['users' => $Training]);
    }

    public function new()
    {
        //aqui no hay
        /*
        $exercisesInTraining = Training::where('role', 'user')
            ->whereDoesntHave('supervisor')
            ->get();
        */
        $idTraining = null;
        $exercisesInTraining = [];
        $exercisesWithoutTraining = Ejercicio::all();

        return view('Training.new', ['idTraining' => $idTraining, 'exercisesInTraining' => $exercisesInTraining, 'exercisesWithoutTraining' => $exercisesWithoutTraining], ['js' => ['tableChanges.js']]);
    }
    //show formClientsUp
    public function edit()
    {

        $exercisesInTraining = Training::where('role', 'user')
            ->whereDoesntHave('supervisor')
            ->get();
        $exercisesWithoutTraining = Training::where('role', 'user')
            ->whereHas('supervisor')
            ->get();

        return view('coach.assignedClients', ['exercisesInTraining' => $exercisesInTraining, 'exercisesWithoutTraining' => $exercisesWithoutTraining], ['js' => ['tableChanges.js']]);
    }
    //strore clients trainer
    public function strore(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',#
            'descripcion' => 'required|string|max:255',
            // Añade reglas de validación adicionales según tus necesidades
        ]);

        // Crear un nuevo entrenamiento
        $training = new Training();
        $training->nombre = $request->nombre;
        $training->descripcion = $request->descripcion;
        $training->save();

        // Asociar ejercicios al entrenamiento
        if ($request->has('ejercicios')) {
            $ejerciciosIds = array_unique($request->ejercicios); // Eliminar duplicados
            foreach ($ejerciciosIds as $ejercicioId) {
                $exercise = Exercise::findOrFail($ejercicioId);
                $training->exercises()->attach($exercise);
            }
        }

        return redirect()->route('entrenamientos.index')->with('success', 'Entrenamiento creado exitosamente.');
    
    }
}
