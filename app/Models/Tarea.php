<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_entrega',
        'proyecto_id',
        'estatus_id',
        'responsable_id'
    ];

    public function proyecto()
    {
        return $this->belongsTo(
            Proyecto::class,
            'proyecto_id',
            'id'
        );
    }

    public function estatus()
    {
        return $this->belongsTo(
            TareaEstatus::class,
            'estatus_id',
            'id'
        );
    }

    public function responsable()
    {
        return $this->belongsTo(
            User::class,
            'responsable_id',
            'id'
        );
    }
}
