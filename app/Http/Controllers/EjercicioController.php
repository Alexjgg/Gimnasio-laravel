<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ejercicio;

class EjercicioController extends Controller
{
    //
    public function index()
    {
        $userId = auth()->user()->id;
        $ejercicios = Ejercicio::where('user_id,', $userId);
        if (auth()->user()->role == 'admin') {
            $ejercicios = Ejercicio::all();
        }

        return view('ejercicios.index', ['ejercicios' => $ejercicios]);
    }

    public function create()
    {
        $textoView = "Nuevo ejercicio";
        $controller = route('ejercicios.store');
        return view('ejercicios.new', ['controller' => $controller, 'textoView' => $textoView]);

    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'descripcion' => 'required|string',
            'repeticiones' => 'required|string',
            'duracion' => 'required|string',
        ]);

        try {
            $ejercicio = new Ejercicio;
            $ejercicio->user_id = auth()->user()->id;
            $ejercicio->name = $request->input('name');
            $ejercicio->descripcion = $request->input('descripcion');
            $ejercicio->repeticiones = $request->input('repeticiones');
            $ejercicio->duracion = $request->input('duracion');
            $ejercicio->save();

            return redirect()->route('ejercicios.index')->with('success', 'Ejercicio creado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error al crear el ejercicio: ' . $e->getMessage()]);
        }

    }
    public function edit($id)
    {
        $ejercicio = Ejercicio::find($id);
        $action = 'PUT';
        $textoView = "Editar ejercicio";
        $controller = route('ejercicios.update', ['id' => $id]);
        return view('ejercicios.new', ['ejercicio' => $ejercicio, 'controller' => $controller, 'action' => $action, 'textoView' => $textoView]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'descripcion' => 'required|string',
            'repeticiones' => 'required|string',
            'duracion' => 'required|string',
        ]);

        try {
            $ejercicio = Ejercicio::findOrFail($id);

            $ejercicio->name = $request->input('name');
            $ejercicio->descripcion = $request->input('descripcion');
            $ejercicio->repeticiones = $request->input('repeticiones');
            $ejercicio->duracion = $request->input('duracion');
            $ejercicio->save();

            return redirect()->route('ejercicios.index')->with('success', 'Ejercicio actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Error al actualizar el ejercicio: ' . $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        $ejercicio = Ejercicio::find($id);

        if (!$ejercicio) {
            return redirect()->route('ejercicios.index')->with('error', 'Ejercicio no encontrado');
        }
        if ($ejercicio->user_id == auth()->user()->id || auth()->user()->role == 'admin') {
            $ejercicio->delete();
            return redirect()->route('ejercicios.index')->with('success', 'Ejercicio eliminado correctamente');
        }
        return redirect()->route('ejercicios.index')->with('error', 'Ejercicio no tienes permisos para eliminar ese ejercicio');

    }
}
