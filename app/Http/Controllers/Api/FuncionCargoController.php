<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FuncionCargo;
use Illuminate\Http\Request;

class FuncionCargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $funciones = FuncionCargo::paginate(10);

    return response()->json($funciones);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'cargo_id' => 'required|exists:cargos,id',
        'descripcion_funcion' => 'required',
        'estado' => 'required|boolean'
    ]);

    $funcion = FuncionCargo::create([
        'cargo_id' => $request->cargo_id,
        'descripcion_funcion' => $request->descripcion_funcion,
        'estado' => $request->estado
    ]);

    return response()->json([
        'message' => 'Función creada correctamente.',
        'data' => $funcion
    ], 201);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $funcion = FuncionCargo::find($id);

    if (!$funcion) {
        return response()->json([
            'message' => 'Función no existe'
        ], 404);
    }

    return response()->json($funcion);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $funcion = FuncionCargo::find($id);

    if (!$funcion) {
        return response()->json([
            'message' => 'Función no existe'
        ], 404);
    }

    $request->validate([
        'cargo_id' => 'required|exists:cargos,id',
        'descripcion_funcion' => 'required',
        'estado' => 'required|boolean'
    ]);

    $funcion->update([
        'cargo_id' => $request->cargo_id,
        'descripcion_funcion' => $request->descripcion_funcion,
        'estado' => $request->estado
    ]);

    return response()->json([
        'message' => 'Función actualizada correctamente.',
        'data' => $funcion
    ]);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $funcion = FuncionCargo::find($id);

    if (!$funcion) {
        return response()->json([
            'message' => 'Función no existe'
        ], 404);
    }

    $funcion->delete();

    return response()->json([
        'message' => 'Función eliminada correctamente.'
    ]);
}
}
