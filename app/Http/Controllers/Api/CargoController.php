<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $cargos = Cargo::paginate(10);

    return response()->json($cargos);
}
    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'nombre_cargo' => 'required|max:255',
        'descripcion' => 'required'
    ], [
        'nombre_cargo.required' => 'El nombre del cargo es obligatorio.',
        'descripcion.required' => 'La descripción es obligatoria.'
    ]);

    $cargo = Cargo::create([
        'nombre_cargo' => $request->nombre_cargo,
        'descripcion' => $request->descripcion
    ]);

    return response()->json([
        'message' => 'Cargo creado correctamente.',
        'data' => $cargo
    ], 201);
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $cargo = Cargo::find($id);

    if (!$cargo) {
        return response()->json([
            'message' => 'Cargo no existe'
        ], 404);
    }

    return response()->json($cargo);
}
    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    $cargo = Cargo::find($id);

    if (!$cargo) {
        return response()->json([
            'message' => 'Cargo no existe'
        ], 404);
    }

    $request->validate([
        'nombre_cargo' => 'required|max:255',
        'descripcion' => 'required'
    ], [
        'nombre_cargo.required' => 'El nombre del cargo es obligatorio.',
        'descripcion.required' => 'La descripción es obligatoria.'
    ]);

    $cargo->update([
        'nombre_cargo' => $request->nombre_cargo,
        'descripcion' => $request->descripcion
    ]);

    return response()->json([
        'message' => 'Cargo actualizado correctamente.',
        'data' => $cargo
    ]);
}

    /**
     * Remove the specified resource from storage.
     */

    public function funciones($id)
{
    $cargo = Cargo::find($id);

    if (!$cargo) {
        return response()->json([
            'message' => 'Cargo no existe'
        ], 404);
    }

    $funciones = $cargo->funcionesCargo()->paginate(10);

    return response()->json($funciones);
}
    public function destroy(string $id)
{
    $cargo = Cargo::find($id);

    if (!$cargo) {
        return response()->json([
            'message' => 'Cargo no existe'
        ], 404);
    }

    $cargo->delete();

    return response()->json([
        'message' => 'Cargo eliminado correctamente.'
    ]);
}
}
