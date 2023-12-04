<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = Tarea::all();

        return response()->json($tareas);
    }

    public function getOne($tareaId)
    {
        $tarea = Tarea::where('id', $tareaId)
            ->first();

        return response()->json($tarea);
    }

    public function storeOne(Request $request)
    {
        $nuevaTarea = Tarea::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'fecha_entrega' => $request->input('fecha_entrega'),
            'responsable_id' => $request->input('responsable_id'),
            'proyecto_id' => $request->input('proyecto_id'),
            'estatus_id' => $request->input('estatus_id')
        ]);

        return response()->json($nuevaTarea);
    }

    public function updateOne(Request $request, $tareaId)
    {
        $tareaActual = Tarea::find($tareaId);

        if (!$tareaActual) {
            return response()->json(['error' => 'Registro no encontrado.'], 404);
        }

        $tareaActual->nombre = $request->input('nombre', $tareaActual->nombre);
        $tareaActual->descripcion = $request->input('descripcion', $tareaActual->descripcion);
        $tareaActual->fecha_entrega = $request->input('fecha_entrega', $tareaActual->fecha_entrega);
        $tareaActual->responsable_id = $request->input('responsable_id', $tareaActual->responsable_id);
        $tareaActual->proyecto_id = $request->input('proyecto_id', $tareaActual->proyecto_id);
        $tareaActual->estatus_id = $request->input('estatus_id', $tareaActual->estatus_id);

        $tareaActual->save();

        return response()->json($tareaActual);
    }

    public function deleteOne($tareaId)
    {
        $tarea = Tarea::find($tareaId);

        $tarea->delete();

        return response()->json(["success" => true], 200);
    }
}
