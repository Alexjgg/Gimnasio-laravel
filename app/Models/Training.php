<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Ejercicioo;
class Training extends Model
{
    use HasFactory;
    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }
    public function exercises()
    {
        return $this->belongsToMany(Exercise::class)->withTimestamps()->withPivot('id');
    }
}
