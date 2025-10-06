<?php 

namespace App\Http\Controllers;

use App\Models\Practicante;
use App\Models\Supervisor;

class DashboardController extends Controller
{
    public function home()
    {
        $supervisores = Supervisor::all();
        $practicantes = Practicante::all();
        $totalSupervisores = Supervisor::count();
        $totalPracticantes = Practicante::count();

        return view('estudiante.index', compact(
            'supervisores',
            'practicantes',
            'totalSupervisores',
            'totalPracticantes'
        ));
    }

    public function dashboard()
    {
        $supervisores = Supervisor::all();
        $practicantes = Practicante::all();
        $totalSupervisores = Supervisor::count();
        $totalPracticantes = Practicante::count();

        return view('graficas.dashboard', compact(
            'supervisores',
            'practicantes',
            'totalSupervisores',
            'totalPracticantes'
        ));
    }
}
