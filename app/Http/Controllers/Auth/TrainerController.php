<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

//Entrenadores
class RegisterController extends Controller
{
    //show clients trainers
    public function index()
    {

        $users = User::all();

        return view('auth.index', ['users' => $users]);
    }
    //show formClientsUp
    public function upClients()
    {

        $usersWithoutTraiener = User::where('role', 'user')
            ->whereDoesntHave('supervisor')
            ->get();
        $usersWithTraiener = User::where('role', 'user')
            ->whereHas('supervisor')
            ->get();

        return view('coach.assignedClients', ['usersWithoutTraiener' => $usersWithoutTraiener, 'usersWithTraiener' => $usersWithTraiener], ['js' => ['tableChanges.js']]);
    }
    //strore clients trainer
    public function stroreClients(Request $request)
    {
        //el Guardodo


        $usersWithoutTraiener = User::where('role', 'user')
            ->whereDoesntHave('supervisor')
            ->get();
        $usersWithTraiener = User::where('role', 'user')
            ->whereHas('supervisor')
            ->get();

        return view('coach.assigned.clients.blade', ['usersWithoutTraiener' => $usersWithoutTraiener, 'usersWithTraiener' => $usersWithTraiener]);
    }
}
