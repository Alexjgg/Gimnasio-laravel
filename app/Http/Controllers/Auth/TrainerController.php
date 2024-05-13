<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

//Entrenadores
class TrainerController extends Controller
{
    //show clients trainers
    public function index()
    {
        //Mis clientes
        $users = User::where('coach_id', auth()->user()->id)->get();

        return view('Trainers.index', ['users' => $users]);
    }
    //show formClientsUp
    public function formUsers()
    {
        $titel = "Mis clientes";
        $controller = route('Trainer.storeUsers');

        $userWithoutTrainer = User::where('role', 'user')
            ->whereDoesntHave('supervisor')
            ->get();
        $userWithTrainer = User::where('role', 'user')
            ->whereHas('supervisor')
            ->get();

        return view('Trainers.storeUsers', ['titel' => $titel, 'controller' => $controller, 'userWithoutTrainer' => $userWithoutTrainer, 'userWithTrainer' => $userWithTrainer], ['js' => ['tableChanges.js']]);
    }

    //strore clients trainer
    public function storeUsers(Request $request)
    {
        //Falta try catch y comprobaciones




        $usersWithTrainerIds = explode(';', $request->input('userWithTrainer'));
        $usersWithoutTrainerIds = explode(';', $request->input('userWithoutTrainer'));

        try {
            foreach ($usersWithTrainerIds as $userId) {

                $user = User::findOrFail($userId);
                $user->coach_id = auth()->user()->id;

                // Guardar los cambios en la base de datos
                $user->save();
            }

            // Desasociar usuarios de entrenador
            foreach ($usersWithoutTrainerIds as $userId) {
                // Obtener el usuario de la base de datos
                $user = User::findOrFail($userId);

                $user->coach_id = null;

                // Guardar los cambios en la base de datos
                $user->save();
            }
        } catch (\Exception $e) {

            return back()->withErrors(['error' => $e . 'Error al actualizar el usuario. Por favor, inténtalo de nuevo.'])->withInput();
        }
        return view('Trainers.index');
    }
}
