<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Training;

//Entrenadores
class TrainerController extends Controller
{
    //show clients trainers
    public function index()
    {
        //Mis clientes
        $users = User::where('trainer_id', auth()->user()->id)->get();

        return view('Trainers.index', ['users' => $users]);
    }
    //show formClientsUp
    public function formUsers()
    {
        $titel = "Mis clientes";
        $controller = route('Trainer.storeUsers');

        $userWithoutTrainer = User::where('role', 'user')
            ->whereDoesntHave('trainer')
            ->get();
        $userWithTrainer = User::where('role', 'user')
            ->whereHas('trainer')
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
                $user->trainer_id = auth()->user()->id;

                // Guardar los cambios en la base de datos
                $user->save();
            }

            // Desasociar usuarios de entrenador
            foreach ($usersWithoutTrainerIds as $userId) {
                // Obtener el usuario de la base de datos
                $user = User::findOrFail($userId);

                $user->trainer_id = null;

                // Guardar los cambios en la base de datos
                $user->save();
            }
        } catch (\Exception $e) {

            return back()->withErrors(['error' => $e . 'Error al actualizar el usuario. Por favor, inténtalo de nuevo.'])->withInput();
        }
        return redirect()->route('Trainers.index');
    }
    public function remove($id)
    {
        //Comprar que es un id entero y comprobar si es de este entrenador

        try {
            $clientId = $id;
            $trainerId = auth()->user()->id;
            $client = User::where('id', $clientId)
                ->where('trainer_id', $trainerId)
                ->firstOrFail();

            // Desasociar al usuario
            $client->trainer_id = null;
            $client->save();

            return response()->json(['message' => 'El usuario ha sido quitado correctamente.'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al quitar el usuario. Por favor, inténtalo de nuevo.'], 500);
        }

    }
    public function showUserTrainings($userId)
    {
        //Comprar que el que el entrenador de este cliente es el de la session



        $user = User::findOrFail($userId);

        $trainerId = $user->trainer_id;

        $trainingsAssigned = $user->trainings;

        // Obtener los entrenamientos del entrenador del usuario
        $trainingsAvailable = Training::where('trainer_id', $trainerId)
            ->whereDoesntHave('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();

        return view('trainings.show', compact('trainingsAssigned', 'trainingsAvailable'));
    }

    public function assignTrainings($id)
    {



    }

}
