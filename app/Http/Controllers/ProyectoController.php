<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::with([
                'responsable',
                'tareas'
            ])
            ->get()
            ->map(function($proyecto) {
                return [
                    'id' => $proyecto->id,
                    'nombre' => $proyecto->nombre,
                    'responsable' => [
                        'id' => $proyecto->responsable->id,
                        'nombre' => $proyecto->responsable->name
                    ],
                    'descripcion' => $proyecto->descripcion,
                    'tareas_resumen' => [
                        'total' => $proyecto->tareas->count(),
                        'finalizadas' => $proyecto->tareas()
                            ->where('estatus_id', 3)
                            ->count()
                    ],
                    'fecha_entrega' => $proyecto->fecha_entrega
                ];
            });

        return response()->json($proyectos);
    }

    public function getOne($proyectoId)
    {
        $proyecto = Proyecto::with([
            'responsable',
            'tareas'
        ])
        ->where('id', $proyectoId)
        ->first();

        $proyecto = [
            'id' => $proyecto->id,
            'nombre' => $proyecto->nombre,
            'responsable' => [
                'id' => $proyecto->responsable->id,
                'nombre' => $proyecto->responsable->name
            ],
            'descripcion' => $proyecto->descripcion,
            'tareas_resumen' => [
                'total' => $proyecto->tareas->count(),
                'finalizadas' => $proyecto->tareas()
                    ->where('estatus_id', 3)
                    ->count()
            ],
            'tareas' => $proyecto->tareas->map(function($tarea) {
                return [
                    'id' => $tarea->id,
                    'nombre' => $tarea->nombre,
                    'descripcion' => $tarea->descripcion,
                    'responsable' => [
                        'id' => $tarea->responsable->id,
                        'nombre' => $tarea->responsable->name
                    ],
                    'estatus' => [
                        'id' => $tarea->estatus->id,
                        'nombre' => $tarea->estatus->nombre
                    ],
                    'fecha_entrega' => $tarea->fecha_entrega
                ];
            }),
            'fecha_entrega' => $proyecto->fecha_entrega
        ];

        return response()->json($proyecto);
    }

    public function storeOne(Request $request)
    {
        $nuevoProyecto = Proyecto::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'fecha_entrega' => $request->input('fecha_entrega'),
            'responsable_id' => $request->input('responsable_id')
        ]);

        return response()->json($nuevoProyecto);
    }

    public function updateOne(Request $request, $proyectoId)
    {
        $proyectoActual = Proyecto::find($proyectoId);

        if (!$proyectoActual) {
            return response()->json(['error' => 'Registro no encontrado.'], 404);
        }

        $proyectoActual->nombre = $request->input('nombre', $proyectoActual->nombre);
        $proyectoActual->descripcion = $request->input('descripcion', $proyectoActual->descripcion);
        $proyectoActual->fecha_entrega = $request->input('fecha_entrega', $proyectoActual->fecha_entrega);
        $proyectoActual->responsable_id = $request->input('responsable_id', $proyectoActual->responsable_id);

        $proyectoActual->save();

        return response()->json($proyectoActual);
    }

    public function deleteOne($proyectoId)
    {
        $proyecto = Proyecto::find($proyectoId);

        $proyecto->delete();

        return response()->json(["success" => true], 200);
    }
}
