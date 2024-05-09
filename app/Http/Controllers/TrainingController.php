<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\Training;

//Entrenamientos
class TrainingController extends Controller
{
    public function index()
    {

        $training = Training::all();
        return view('Training.index', ['trainings' => $training]);

    }

    public function new()
    {
        $idTraining = null;
        $exercisesInTraining = [];
        $exercisesWithoutTraining = Exercise::all();

        return view('Training.new', ['idTraining' => $idTraining, 'exercisesInTraining' => $exercisesInTraining, 'exercisesWithoutTraining' => $exercisesWithoutTraining], ['js' => ['tableChanges.js']]);
    }
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
    //Guardado de entrenamientos
    public function strore(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'dia' => ['required', 'string', 'in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo'],
            // Añade reglas de validación adicionales según tus necesidades
        ]);

        //Limpiando codigo, hacer una fucion para limpiar todas las request primero, para el resto de controllers importante
        $nombre = htmlspecialchars(strip_tags($request->input('nombre')));
        $descripcion = htmlspecialchars(strip_tags($request->input('descripcion')));
        $dia = ucfirst($request->input('dia'));

        // Crear un nuevo entrenamiento
        $training = new Training();
        $training->nombre = $nombre;
        $training->descripcion = $descripcion;
        $training->descripcion = $dia;
        $training->save();

        //En un futuro comprobar que los ejercicios son los de los propios entrenador
        // Asociar ejercicios al entrenamiento      
        if ($request->has('ejercicios')) {
            $ejerciciosIds = array_unique($request->ejercicios); // Eliminar duplicados
            foreach ($ejerciciosIds as $ejercicioId) {
                $exercise = Exercise::findOrFail($ejercicioId);
                $training->exercises()->attach($exercise);
            }
        }

        return redirect()->route('Trainings.index')->with('success', 'Entrenamiento creado exitosamente.');

    }
}
