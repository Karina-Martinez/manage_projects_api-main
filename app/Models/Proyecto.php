<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_entrega',
        'responsable_id'
    ];

    public function responsable()
    {
        return $this->belongsTo(
            User::class,
            'responsable_id',
            'id'
        );
    }

    public function tareas()
    {
        return $this->hasMany(
            Tarea::class,
            'proyecto_id',
            'id'
        );
    }
}
