<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\FuncionCargo;

class EmpleadoController extends Controller
{
    /**
     * Listar empleados
     */
    public function index()
    {
        $empleados = Empleado::paginate(10);

        return response()->json($empleados);
    }

    /**
     * Crear empleado
     */
    public function store(Request $request)
    {
        $request->validate([
            'cargo_id' => 'required|exists:cargos,id',
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'fecha_nacimiento' => 'required|date',
            'fecha_ingreso' => 'required|date',
            'salario' => 'required|numeric',
            'estado' => 'required|boolean'
        ], [
            'cargo_id.required' => 'El cargo es obligatorio.',
            'cargo_id.exists' => 'El cargo seleccionado no existe.',
            'nombres.required' => 'Los nombres son obligatorios.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
            'salario.required' => 'El salario es obligatorio.',
            'estado.required' => 'El estado es obligatorio.'
        ]);

        $empleado = Empleado::create([
            'cargo_id' => $request->cargo_id,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'fecha_ingreso' => $request->fecha_ingreso,
            'salario' => $request->salario,
            'estado' => $request->estado
        ]);

        return response()->json([
            'message' => 'Empleado creado correctamente.',
            'data' => $empleado
        ], 201);
    }

    /**
     * Mostrar empleado
     */
    public function show(string $id)
    {
        $empleado = Empleado::find($id);

        if (!$empleado) {
            return response()->json([
                'message' => 'Empleado no existe'
            ], 404);
        }

        return response()->json($empleado);
    }

    /**
     * Actualizar empleado
     */
    public function update(Request $request, string $id)
    {
        $empleado = Empleado::find($id);

        if (!$empleado) {
            return response()->json([
                'message' => 'Empleado no existe'
            ], 404);
        }

        $request->validate([
            'cargo_id' => 'required|exists:cargos,id',
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'fecha_nacimiento' => 'required|date',
            'fecha_ingreso' => 'required|date',
            'salario' => 'required|numeric',
            'estado' => 'required|boolean'
        ], [
            'cargo_id.required' => 'El cargo es obligatorio.',
            'cargo_id.exists' => 'El cargo seleccionado no existe.',
            'nombres.required' => 'Los nombres son obligatorios.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
            'salario.required' => 'El salario es obligatorio.',
            'estado.required' => 'El estado es obligatorio.'
        ]);

        $empleado->update([
            'cargo_id' => $request->cargo_id,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'fecha_ingreso' => $request->fecha_ingreso,
            'salario' => $request->salario,
            'estado' => $request->estado
        ]);

        return response()->json([
            'message' => 'Empleado actualizado correctamente.',
            'data' => $empleado
        ]);
    }

    /**
     * Detalle de empleado
     */
    public function detalle($id)
    {
        $empleado = Empleado::with('cargo')->find($id);

        if (!$empleado) {
            return response()->json([
                'message' => 'Empleado no existe'
            ], 404);
        }

        $funciones = FuncionCargo::where('cargo_id', $empleado->cargo_id)
            ->select('id', 'descripcion_funcion', 'estado')
            ->get();

        return response()->json([
            'id' => $empleado->id,
            'nombres' => $empleado->nombres,
            'apellidos' => $empleado->apellidos,
            'salario' => $empleado->salario,
            'cargo' => [
                'id' => $empleado->cargo->id,
                'nombre_cargo' => $empleado->cargo->nombre_cargo
            ],
            'funciones' => $funciones
        ]);
    }

    /**
     * Eliminar empleado
     */
    public function destroy(string $id)
    {
        $empleado = Empleado::find($id);

        if (!$empleado) {
            return response()->json([
                'message' => 'Empleado no existe'
            ], 404);
        }

        $empleado->delete();

        return response()->json([
            'message' => 'Empleado eliminado correctamente.'
        ]);
    }
}