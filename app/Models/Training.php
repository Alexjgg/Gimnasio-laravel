<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exercise;

//Entrenamiento
class Training extends Model
{
    protected $fillable = ['id', 'name', 'day', 'trainer_id']; // Añade 'id' a $fillable

    use HasFactory;
    //Optengo el id del entrenador de este entrenamiento
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
    //Optengo los ejercicios del entrenamiento
    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'training_exercise')->withTimestamps()->withPivot('id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_training');
    }
}
