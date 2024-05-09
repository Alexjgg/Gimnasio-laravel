<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Ejercicioo;

//Entrenamiento
class Training extends Model
{
    use HasFactory;
    //Optengo el id del entrenador de este entrenamiento
    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }
    //Optengo los ejercicios del entrenamiento
    public function exercises()
    {
        return $this->belongsToMany(Exercise::class)->withTimestamps()->withPivot('id');
    }
}
