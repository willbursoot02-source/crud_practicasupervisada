<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Supervisor;
use App\Models\Practicante;
use App\Models\Control;

class ControlController extends Controller
{
    public function mostrar_control()
    {
        $control = Control::get();

        foreach ($control as $item) {

            $item->nombre_practicante = Practicante::where('id_practicante', $item->id_practicante)->value('nombre');
            $item->nombre_supervisor = Supervisor::where('id_supervisor', $item->id_supervisor)->value('nombre');
            $item->estado_texto = $item->estado ? 'Activo' : 'Inactivo';
        }

        return view('control.listado', ['control' => $control]);

    }


    public function mostrar_agregar()
    {
        $supervisores = Supervisor::where('estado', 1)->select('id_supervisor', 'nombre')->get();
        $practicantes = Practicante::where('estado', 1)->select('id_practicante', 'nombre')->get();



        return view('control.agregar', compact('supervisores', 'practicantes'));

    }

    public function control_guardar(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_supervisor' => 'required',
                'id_practicante' => 'required',
                'fecha' => 'required',
                'comentario' => 'required',
            ],
            [
                'id_supervisor.required' => 'Debe seleccionar un supervisor.',
                'id_practicante.required' => 'Debe seleccionar un practicante.',
                'fecha.required' => 'Debe ingresar la fecha.',
                'comentario.required' => 'Debe ingresar un comentario.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'title' => 'Datos incompletos',
                'message' => implode("\n", $validator->errors()->all())
            ]);
        }

        Control::create([
            'id_supervisor' => $request->id_supervisor,
            'id_practicante' => $request->id_practicante,
            'fecha_control' => now(),
            'comentario' => $request->comentario,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registro de control guardado correctamente.'
        ]);
    }

    public function editar($id)
    {
        $control = Control::findOrFail($id);
        $supervisores = Supervisor::where('estado', 1)->select('id_supervisor', 'nombre')->get();
        $practicantes = Practicante::where('estado', 1)->select('id_practicante', 'nombre')->get();

        return view('control.editar', compact('control', 'supervisores', 'practicantes'));
    }

    public function actualizar(Request $request, $id)
    {
        $control = Control::findOrFail($id);

        $control->update([
            'id_supervisor' => $request->id_supervisor,
            'id_practicante' => $request->id_practicante,
            'fecha_control' => $request->fecha_control,
            'comentario' => $request->comentario,
        ]);

        return redirect()->route('control.mostrar')->with('success', 'Control actualizado correctamente.');
    }

    public function busqueda_mostrar()
    {

        return view("control/buscar");

    }

    public function consulta_dpi(Request $request)
    {
        $supervisor = Supervisor::where('cui', $request->dpi)->first();

        if ($supervisor) {
            return response()->json([
                'success' => true,
                'data' => [
                    'nombre' => $supervisor->nombre,
                    'telefono' => $supervisor->telefono,
                    'correo' => $supervisor->correo,
                    'cargo' => $supervisor->cargo,
                    'sexo' => $supervisor->sexo,
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'title' => 'No encontrado',
                'message' => 'No existe ningún registro con ese DPI.'
            ]);
        }
    }

    //graficas

    public function graficas()
    {
        $supervisores = Supervisor::select('sexo')->get();
        $practicantes = Practicante::select('edad', 'institucion')->get();

        $totalSupervisores = Supervisor::count();
        $totalPracticantes = Practicante::count();

        $generos = ['Masculino', 'Femenino'];


        return view('graficas.index', compact('supervisores', 'practicantes', 'totalSupervisores', 'totalPracticantes', 'generos'));
    }


}
