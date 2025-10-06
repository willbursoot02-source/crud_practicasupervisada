<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticanteController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\DashboardController;

use App\Models\Supervisor;
use App\Models\Practicante;

function getDashboardData() {
    $supervisores = Supervisor::all();
    $practicantes = Practicante::all();
    $totalSupervisores = Supervisor::count();
    $totalPracticantes = Practicante::count();
    return compact('supervisores', 'practicantes', 'totalSupervisores', 'totalPracticantes');
}
Route::get('/', function () {
    return view('estudiante.index', getDashboardData());
})->name('home');

Route::get('/dashboard', function () {
    return view('graficas.dashboard', getDashboardData());
})->name('dashboard');

//Practicante
Route::get('/practicante/listado/practicantes', [PracticanteController::class, 'mostrar'])->name('practicante.mostrar');
Route::get('/practicante/agregar/practicantes', [PracticanteController::class, 'mostrar_agregar'])->name('practicante.agregar');
Route::post('/practicante/guardar/practicantes', [PracticanteController::class, 'practicante_guardar'])->name('practicante.guardar');
Route::get('/practicante/{id}/editar', [PracticanteController::class, 'editar'])->name('practicante.editar');
Route::put('/practicante/{id}/actualizar', [PracticanteController::class, 'actualizar'])->name('practicante.actualizar');
Route::get('/practicante/{id}/inactivar', [PracticanteController::class, 'practicante_inactivar'])->name('practicante.inactivar');
Route::get('/practicante/{id}/activar', [PracticanteController::class, 'practicante_activar'])->name('practicante.activar');
//prueba
Route::get('/practicante/datos/actualizar/{id}', [PracticanteController::class, 'actualizar_practicante']);
Route::post('/practicante/guardar', [PracticanteController::class, 'actualizar_datos_practicante'])->name('practicante.guardar');
Route::get('/practicante/listado', [PracticanteController::class, 'listado'])->name('practicante.listado');
// supervisor
Route::get('/supervisor/datos/{id}', [SupervisorController::class, 'obtener'])->name('supervisor.obtener');
// supervisor
Route::post('/supervisor/guardar', [SupervisorController::class, 'guardar'])->name('supervisor.guardar');

//Supervisor
Route::get('/supervisor/listado/supervisor', [SupervisorController::class, 'mostrar_supervisor'])->name('supervisor.mostrar');
Route::get('/supervisor/agregar/supervisor', [SupervisorController::class, 'supervisor_agregar'])->name('supervisor.agregrar');
Route::post('/supervisor/guardar/supervisor', [SupervisorController::class, 'supervisor_guardar'])->name('supervisor.guardar');
Route::get('/supervisor/{id}/editar', [SupervisorController::class, 'editar'])->name('supervisor.editar');
Route::put('/supervisor/{id}/actualizar', [SupervisorController::class, 'actualizar'])->name('supervisor.actualizar');
Route::get('/supervisor/{id}/inactivar', [SupervisorController::class, 'supervisor_inactivar'])->name('supervisor.inactivar');
Route::get('/supervisor/{id}/activar', [SupervisorController::class, 'supervisor_activar'])->name('supervisor.activar');

// Control
Route::get('/control/listado/control', [ControlController::class, 'mostrar_control'])->name('control.mostrar');
Route::get('/control/agregar/control', [ControlController::class, 'mostrar_agregar'])->name('control.agregar');
Route::post('/control/guardar/control', [ControlController::class, 'control_guardar'])->name('control.guardar');
Route::get('/control/{id}/editar', [ControlController::class, 'editar'])->name('control.editar');
Route::put('/control/{id}/actualizar', [ControlController::class, 'actualizar'])->name('control.actualizar');
Route::get('/control/buscar/control', [ControlController::class, 'busqueda_mostrar'])->name('busqueda.mostrar');
Route::post('/consulta-dpi', [ControlController::class, 'consulta_dpi'])->name('consulta.dpi');
Route::get('/control/graficas', [ControlController::class, 'graficas'])->name('graficas.index');
Route::get('/control/graficas', [ControlController::class, 'graficas'])->name('graficas.index');
Route::get('/control/obtener/{id}', [ControlController::class, 'obtener']);
Route::post('/control/guardar', [ControlController::class, 'guardar']);





