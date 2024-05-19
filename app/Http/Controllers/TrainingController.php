<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\Training;
USE Illuminate\Support\Facades\Auth;
//Entrenamientos
class TrainingController extends Controller
{
    public function index()
    {
      //  if(Auth::check() && auth()->user()->role == "training"){

        $training = Training::all();
        return view('Training.index', ['trainings' => $training]);
        
        //}
        return view('index');

    }

    public function new()
    {
        //if(Auth::check() && auth()->user()->role == "training"){

            $titel = "Nuevo entrenamiento";
            $controller = route('Trainings.store');
            $exercisesInTraining = [];
            $exercisesWithoutTraining = Exercise::all();

            return view('Training.new', ['titel' => $titel, 'controller' => $controller, 'exercisesInTraining' => $exercisesInTraining, 'exercisesWithoutTraining' => $exercisesWithoutTraining], ['js' => ['tableChanges.js']]);
        //}
      return view('index');

    }
    public function edit($id)
    {
        // En id hay que hace comprobaciones

        $titel = "Editando entrenamiento";
        $controller = route('Trainings.store');
        try {
            $training = Training::findOrFail($id);
            $idTraining = $id;

            $exercisesInTraining = $training->exercises;
            $exercisesWithoutTraining = Exercise::all()->diff($exercisesInTraining);

            return view('Training.new', ['training' => $training, 'titel' => $titel, 'controller' => $controller, 'id_training' => $idTraining, 'exercisesInTraining' => $exercisesInTraining, 'exercisesWithoutTraining' => $exercisesWithoutTraining], ['js' => ['tableChanges.js']]);


        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['errors' => 'Error al editar Entrenamiento: ' . $e->getMessage()]);
        }

    }
    //Guardado de entrenamientos
    public function store(Request $request)
    {
        $request->validate([
            'nameTraining' => 'required|string|max:255',
            'dia' => ['required', 'string', 'in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo'],
        ]);

        //Limpiando codigo, hacer una fucion para limpiar todas las request primero, para el resto de controllers importante
        $nameTraining = htmlspecialchars(strip_tags($request->input('nameTraining')));
        $dia = ucfirst($request->input('dia'));
        $trainingId = ucfirst($request->input('id_training'));

        try {

            if ($trainingId == "New") {
                $training = new Training();
            } else {
                $training = Training::findOrFail($trainingId);
            }
            $training->name = $nameTraining;
            $training->day = $dia;
            $training->trainer_id = auth()->user()->id;
            $training->save();

            //En un futuro comprobar que los ejercicios son los de los propios entrenador
            // Asociar ejercicios al entrenamiento 


            //Compruebo el insertatdo de ejercicios
            if ($request->has('exercisesInTraining')) {
                $exercisesIds = explode(';', $request->input('exercisesInTraining'));
                $training->exercises()->sync($exercisesIds);

            }
            //Compruebo los ejercicios que voy a quitar
            if ($request->has('exercisesWithoutTraining')) {
                $exercisesIds = explode(';', $request->input('exercisesWithoutTraining'));
                $exercisesIds = array_unique($exercisesIds); // Eliminar duplicados
                foreach ($exercisesIds as $exerciseId) {
                    //Compruebo si existe el ejercicio en el entreno
                    if ($training->exercises->contains($exerciseId)) {
                        $training->exercises()->detach($exerciseId);
                    }
                }
            }
            return redirect()->route('Trainings.index')->with('success', 'Entrenamiento creado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['errors' => 'Error al guardar el entrenamiento: ' . $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        $training = Training::find($id);

        if (!$training) {
            return redirect()->route('Trainings.index')->with('error', 'Entrenamiento no encontrado');
        }

        if ($training->trainer_id == auth()->user()->id || auth()->user()->role == 'admin') {

            try {
                $training->delete();
                return redirect()->route('Trainings.index')->with('success', 'Entrenamiento borrado correctamente');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->withErrors(['errors' => 'Error al intentar borrar el entrenamiento: ' . $e->getMessage()]);
            }

        }
        return redirect()->route('Trainings.index')->with('error', 'Entrenamiento no tienes permisos para borrar este entrenamiento');

    }
}
