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
    public function getId()
    {
        return $this->id;
    }

    // Setter for 'id'
    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter for 'name'
    public function getName()
    {
        return $this->name;
    }

    // Setter for 'name'
    public function setName($name)
    {
        $this->name = $name;
    }

    // Getter for 'day'
    public function getDay()
    {
        return $this->day;
    }

    // Setter for 'day'
    public function setDay($day)
    {
        $this->day = $day;
    }

    // Getter for 'trainer_id'
    public function getTrainerId()
    {
        return $this->trainer_id;
    }

    // Setter for 'trainer_id'
    public function setTrainerId($trainer_id)
    {
        $this->trainer_id = $trainer_id;
    }
}
