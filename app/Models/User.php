<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    //Las relaciones entre Clientes y Entrenadores

    /////// Entrenamientos
    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'user_training', 'user_id', 'training_id');
    }
    // Un usuario solo puede tener asociado un entrenador
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    //un entrenador puede tener varios clientes
    public function trainees()
    {
        return $this->hasMany(User::class, 'trainer_id');
    }
        // Getter for 'id'
        public function getId()
        {
            return $this->id;
        }
    
        // Setter for 'id' (usualmente no se necesita ya que 'id' es autoincremental)
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
    
        // Getter for 'email'
        public function getEmail()
        {
            return $this->email;
        }
    
        // Setter for 'email'
        public function setEmail($email)
        {
            $this->email = $email;
        }
    
        // Getter for 'password'
        public function getPassword()
        {
            return $this->password;
        }
}