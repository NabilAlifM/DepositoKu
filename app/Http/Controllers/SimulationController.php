<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Simulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimulationController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        $recentSimulations = Simulation::with(['bank', 'user'])
            ->where('user_id', Auth::id())
            ->orderBy('waktu_simulasi', 'desc')
            ->limit(5)
            ->get();
        
        return view('simulations.index', compact('banks', 'recentSimulations'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'bank_id' => 'required|exists:banks,bank_id',
            'nominal_deposito' => 'required|numeric|min:1000000',
            'jangka_waktu_bulan' => 'required|integer|in:1,3,6,12,24,36,60'
        ]);

        $bank = Bank::findOrFail($request->bank_id);
        $banks = Bank::all(); 
        $nominal = $request->nominal_deposito;
        $jangkaWaktu = $request->jangka_waktu_bulan;
        
        $bungaDiterima = ($nominal * $bank->suku_bunga_dasar * $jangkaWaktu) / (12 * 100);
        $totalAkhir = $nominal + $bungaDiterima;
        
        $pajak = $bungaDiterima * 0.20;
        $bungaBersih = $bungaDiterima - $pajak;
        $totalAkhirBersih = $nominal + $bungaBersih;
        
        $result = [
            'bank' => $bank,
            'nominal' => $nominal,
            'jangka_waktu' => $jangkaWaktu,
            'bunga_kotor' => $bungaDiterima,
            'pajak' => $pajak,
            'bunga_bersih' => $bungaBersih,
            'total_akhir' => $totalAkhirBersih
        ];
        
        return view('simulations.calculate', compact('result', 'banks'));
    }

    public function compare(Request $request)
    {
        $request->validate([
            'bank_ids' => 'required|array|min:2|max:3',
            'bank_ids.*' => 'exists:banks,bank_id',
            'nominal_deposito' => 'required|numeric|min:1000000',
            'jangka_waktu_bulan' => 'required|integer'
        ]);

        $bankIds = $request->bank_ids;
        $nominal = $request->nominal_deposito;
        $jangkaWaktu = $request->jangka_waktu_bulan;
        
        $results = [];
        
        foreach ($bankIds as $bankId) {
            $bank = Bank::find($bankId);
            if ($bank) {
                $bungaDiterima = ($nominal * $bank->suku_bunga_dasar * $jangkaWaktu) / (12 * 100);
                $pajak = $bungaDiterima * 0.20;
                $bungaBersih = $bungaDiterima - $pajak;
                $totalAkhir = $nominal + $bungaBersih;
                
                $results[] = [
                    'bank' => $bank,
                    'bunga_kotor' => $bungaDiterima,
                    'pajak' => $pajak,
                    'bunga_bersih' => $bungaBersih,
                    'total_akhir' => $totalAkhir
                ];
            }
        }
        
        // Urutkan berdasarkan total akhir tertinggi
        usort($results, function($a, $b) {
            return $b['total_akhir'] <=> $a['total_akhir'];
        });
        
        return view('simulations.compare', compact('results', 'nominal', 'jangkaWaktu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_id' => 'required|exists:banks,bank_id',
            'nominal_deposito' => 'required|numeric',
            'jangka_waktu_bulan' => 'required|integer',
            'bunga_diterima' => 'required|numeric',
            'total_akhir' => 'required|numeric'
        ]);

        Simulation::create([
            'user_id' => Auth::id(),
            'bank_id' => $request->bank_id,
            'nominal_deposito' => $request->nominal_deposito,
            'jangka_waktu_bulan' => $request->jangka_waktu_bulan,
            'bunga_diterima' => $request->bunga_diterima,
            'total_akhir' => $request->total_akhir,
            'waktu_simulasi' => now()
        ]);

        return redirect()->route('simulations.history')
            ->with('success', 'Simulasi berhasil disimpan!');
    }

    public function history()
    {
        $simulations = Simulation::with(['bank', 'user'])
            ->where('user_id', Auth::id())
            ->orderBy('waktu_simulasi', 'desc')
            ->paginate(15);
        
        return view('simulations.history', compact('simulations'));
    }
}