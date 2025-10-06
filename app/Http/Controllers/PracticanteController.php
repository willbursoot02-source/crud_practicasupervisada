<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Practicante;

class PracticanteController extends Controller
{
    public function mostrar()
    {
        $practicante = Practicante::get();

        foreach ($practicante as $item) {
            $item->estado_texto = $item->estado ? 'Activo' : 'Inactivo';
        }

        return view("practicante.listado", compact('practicante'));

    }

    public function mostrar_agregar()
    {

        return view("practicante/agregar");

    }
    public function practicante_guardar(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nombre' => 'required',
                'edades' => 'required',
                'telefono' => 'required|digits:8',
                'institucion' => 'required',
                'carrera' => 'required',
                'area' => 'required',
            ],
            [
                'nombre.required' => 'Debe llenar el nombre completo',
                'edades.required' => 'Debe ingresar la edad',
                'telefono.required' => 'Debe ingresar el número de teléfono',
                'telefono.digits' => 'El teléfono debe contener exactamente 8 números.',
                'institucion.required' => 'Debe ingresar la institucion',
                'carrera.required' => 'Debe ingresar la carrera',
                'area.required' => 'Debe ingresar el area',
            ]
        );


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'title' => 'Datos incompletos',
                'message' => implode("\n", $validator->errors()->all())
            ]);
        }

        //Mas espeficifico
        if (!is_numeric($request->edades)) {
            return response()->json([
                'success' => false,
                'message' => 'Debe ingresar un número en el campo edad'
            ]);
        }

        if ($request->edades <= 18) {
            return response()->json([
                'success' => false,
                'message' => 'Debe ser mayor de 18 años'
            ]);
        }

        if (!is_numeric($request->telefono)) {
            return response()->json([
                'success' => false,
                'message' => 'Debe ingresar un número en el campo de telefono'
            ]);
        }

        $practicante = Practicante::create([
            'nombre' => $request->nombre,
            'edad' => $request->edades,
            'telefono' => $request->telefono,
            'institucion' => $request->institucion,
            'carrera' => $request->carrera,
            'area' => $request->area,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registro completado correctamente'
        ]);


    }

    public function actualizar(Request $request, $id)
    {
        $practicante = Practicante::findOrFail(id: $id);
        $practicante->update($request->all());
        return redirect()->route('practicante.mostrar')->with('success', 'Practicante actualizado correctamente.');
    }


    public function actualizar_practicante($id)
    {
        $practicante = Practicante::find($id);

        if ($practicante) {
            return response()->json($practicante);
        }

        return response()->json(['error' => 'Practicante no encontrado'], 404);
    }

    public function actualizar_datos_practicante(Request $request)
    {
        $practicante = Practicante::find($request->id_practicante);

        if ($practicante) {
            $practicante->nombre = $request->nombre;
            $practicante->edad = $request->edades;
            $practicante->telefono = $request->telefono;
            $practicante->institucion = $request->institucion;
            $practicante->carrera = $request->carrera;
            $practicante->area = $request->area;

            $practicante->save();

            return response()->json([
                'success' => true,
                'title' => 'Actualización exitosa',
                'message' => 'Los datos del practicante se han actualizado correctamente',
                'practicante' => $practicante
            ]);
        }

        return response()->json([
            'success' => false,
            'title' => 'Error',
            'message' => 'No se encontró el practicante'
        ]);
    }


    public function practicante_inactivar(Request $request, $id)
    {
        $practicante = Practicante::where('id_practicante', $id)->first();

        if ($practicante) {
            $practicante->estado = false;
            $practicante->save();
        }

        return redirect()->route('practicante.mostrar')->with('success', 'Practicante inactivado correctamente.');
    }

    public function practicante_activar(Request $request, $id)
    {
        $practicante = Practicante::where('id_practicante', $id)->first();

        if ($practicante) {
            $practicante->estado = true;
            $practicante->save();
        }

        return redirect()->route('practicante.mostrar')->with('success', 'Practicante activado correctamente.');
    }



}
