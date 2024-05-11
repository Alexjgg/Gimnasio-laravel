<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;

class ExerciseController extends Controller
{
    //
    public function index()
    {
        $userId = auth()->user()->id;
        $exercises = Exercise::where('user_id,', $userId);
        if (auth()->user()->role == 'admin') {
            $exercises = Exercise::all();
        }

        return view('Exercises.index', ['exercises' => $exercises]);
    }

    public function create()
    {
        $textoView = "Nuevo ejercicio";
        $controller = route('Exercises.store');
        return view('Exercises.new', ['controller' => $controller, 'textoView' => $textoView]);

    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'repetitions' => 'required|string',
            'duration' => 'required|string',
        ]);

        try {
            $exercise = new Exercise;
            $exercise->user_id = auth()->user()->id;
            $exercise->name = $request->input('name');
            $exercise->description = $request->input('description');
            $exercise->repetitions = $request->input('repetitions');
            $exercise->duration = $request->input('duration');
            $exercise->save();

            return redirect()->route('Exercises.index')->with('success', 'Ejercicio creado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error al crear el ejercicio: ' . $e->getMessage()]);
        }

    }
    public function edit($id)
    {
        $exercise = Exercise::find($id);
        $action = 'PUT';
        $textoView = "Editar ejercicio";
        $controller = route('Exercises.update', ['id' => $id]);
        return view('Exercises.new', ['exercise' => $exercise, 'controller' => $controller, 'action' => $action, 'textoView' => $textoView]);
    }

    //Falta comprobacion de que de que se esta actualizando el ejercicio adecuado
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'repetitions' => 'required|string',
            'duracion' => 'required|string',
        ]);
        try {
            $exercise = Exercise::findOrFail($id);

            $exercise->name = $request->input('name');
            $exercise->description = $request->input('descripcion');
            $exercise->repeticiones = $request->input('repetitions');
            $exercise->duracion = $request->input('duracion');
            $exercise->save();

            return redirect()->route('Exercises.index')->with('success', 'Ejercicio actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error al actualizar el ejercicio: ' . $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        $exercise = Exercise::find($id);

        if (!$exercise) {
            return redirect()->route('Exercises.index')->with('error', 'Ejercicio no encontrado');
        }
        if ($exercise->user_id == auth()->user()->id || auth()->user()->role == 'admin') {
            $exercise->delete();
            return redirect()->route('Exercises.index')->with('success', 'Ejercicio eliminado correctamente');
        }
        return redirect()->route('Exercises.index')->with('error', 'Ejercicio no tienes permisos para eliminar ese ejercicio');

    }
}
