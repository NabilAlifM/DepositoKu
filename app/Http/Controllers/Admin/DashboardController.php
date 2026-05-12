<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Simulation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        // Statistik umum
        $stats = [
            'total_users' => User::count(),
            'total_banks' => Bank::count(),
            'total_simulations' => Simulation::count(),
            'total_nominal' => Simulation::sum('nominal_deposito'),
        ];

        // Bank paling populer (5 teratas)
        $popularBanks = Simulation::select('bank_id', DB::raw('COUNT(*) as total'))
            ->groupBy('bank_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->with('bank')
            ->get();

        // Simulasi terbaru (10 terakhir)
        $recentSimulations = Simulation::with(['user', 'bank'])
            ->orderBy('waktu_simulasi', 'desc')
            ->limit(10)
            ->get();

        // Grafik simulasi per bulan (12 bulan terakhir)
        $monthlySimulations = Simulation::select(
            DB::raw('DATE_FORMAT(waktu_simulasi, "%Y-%m") as month'),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(nominal_deposito) as total_nominal')
        )
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get()
            ->reverse();

        return view('admin.dashboard', compact(
            'stats',
            'popularBanks',
            'recentSimulations',
            'monthlySimulations'
        ));
    }
}