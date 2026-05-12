<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Simulation;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Http\Request;

class SimulationController extends Controller
{
    /**
     * Display a listing of simulations with filters
     */
    public function index(Request $request)
    {
        $query = Simulation::with(['user', 'bank']);

        // Filter berdasarkan bank
        if ($request->filled('bank_id')) {
            $query->where('bank_id', $request->bank_id);
        }

        // Filter berdasarkan user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('waktu_simulasi', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('waktu_simulasi', '<=', $request->date_to);
        }

        $simulations = $query->orderBy('waktu_simulasi', 'desc')->paginate(20);

        // Data untuk filter dropdown
        $banks = Bank::orderBy('nama_bank')->get();
        $users = User::orderBy('name')->get();

        return view('admin.simulations.index', compact('simulations', 'banks', 'users'));
    }

    /**
     * Display the specified simulation
     */
    public function show(Simulation $simulation)
    {
        $simulation->load(['user', 'bank']);
        return view('admin.simulations.show', compact('simulation'));
    }

    /**
     * Remove the specified simulation
     */
    public function destroy(Simulation $simulation)
    {
        $simulation->delete();
        
        return redirect()->route('admin.simulations.index')
            ->with('success', 'Riwayat simulasi berhasil dihapus');
    }
}