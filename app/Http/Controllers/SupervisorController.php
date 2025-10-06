<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Supervisor;

class SupervisorController extends Controller
{
    public function mostrar_supervisor()
    {
        $supervisores = Supervisor::get();

         foreach ($supervisores as $item) {
            $item->estado_texto = $item->estado ? 'Activo' : 'Inactivo';
        }

        return view("supervisor.listado", compact('supervisores'));
    }


    public function supervisor_agregar()
    {
        $generos = ['Masculino', 'Femenino'];
        return view('supervisor.agregar', compact('generos'));

    }
    public function supervisor_guardar(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nombre' => 'required',
                'cui' => 'required|digits:13',
                'telefono' => 'required|numeric|digits:8',
                'correo' => 'required',
                'cargo' => 'required',
                'sexo' => 'required',
            ],
            [
                'nombre.required' => 'Debe llenar el nombre completo',
                'cui.required' => 'Debe ingresar su DPI',
                'cui.numeric' => 'El DPI solo debe contener números',
                'cui.digits' => 'El DPI debe tener exactamente 13 dígitos',
                'telefono.required' => 'Debe ingresar llenar el campo de telefono',
                'telefono.numeric' => 'Debe ingresar un número en el campo de telefono',
                'telefono.digits' => 'Debe ingresar 8 digitos en el campo de telefono',
                'correo.required' => 'Debe ingresar la institucion',
                'cargo.required' => 'Debe ingresar el cargo',
                'sexo.required' => 'Debe seleccionar el sexo',
            ]
        );


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'title' => 'Datos incompletos',
                'message' => implode("\n", $validator->errors()->all())
            ]);
        }

        $correo = $request->correo;
        if (!preg_match('/@gmail\.com$/', $correo)) {
            return response()->json([
                'success' => false,
                'message' => 'El correo debe terminar en @gmail.com'
            ]);
        }

        $supervisor = Supervisor::create([
            'nombre' => $request->nombre,
            'cui' => $request->cui,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'cargo' => $request->cargo,
            'sexo' => $request->sexo,
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Registro completado correctamente'
        ]);

    }

    //public function editar($id){$supervisor = Supervisor::findOrFail($id);return view('supervisor.editar', compact('supervisor'));}

    //public function actualizar(Request $request, $id){$supervisor = Supervisor::findOrFail($id);$supervisor->update($request->all());return redirect()->route('supervisor.mostrar')->with('success', 'supervisor actualizado correctamente.');}

    public function obtener($id)
    {
        $supervisor = Supervisor::find($id);

        if ($supervisor) {
            return response()->json($supervisor);
        }

        return response()->json(['error' => 'Supervisor no encontrado'], 404);
    }

    public function guardar(Request $request)
    {
        $supervisor = Supervisor::find($request->id_supervisor);

        if ($supervisor) {
            $supervisor->nombre = $request->nombre;
            $supervisor->cui = $request->dpi;
            $supervisor->telefono = $request->telefono;
            $supervisor->correo = $request->correo;
            $supervisor->cargo = $request->cargo;
            $supervisor->sexo = $request->sexo;

            $supervisor->save();

            return response()->json([
                'success' => true,
                'title' => 'Actualización exitosa',
                'message' => 'Los datos del supervisor se han actualizado correctamente',
                'supervisor' => $supervisor
            ]);
        }

        return response()->json([
            'success' => false,
            'title' => 'Error',
            'message' => 'No se encontró el supervisor'
        ]);
    }

    public function supervisor_inactivar(Request $request, $id)
    {
        $supervisor = Supervisor::where('id_supervisor', $id)->first();

        if ($supervisor) {
            $supervisor->estado = false;
            $supervisor->save();
        }

        return redirect()->route('supervisor.mostrar')->with('success', 'Supervisor inactivado correctamente.');
    }

    public function supervisor_activar(Request $request, $id)
    {
        $supervisor = Supervisor::where('id_supervisor', $id)->first();

        if ($supervisor) {
            $supervisor->estado = true;
            $supervisor->save();
        }

        return redirect()->route('supervisor.mostrar')->with('success', 'Supervisor activado correctamente.');
    }

}
