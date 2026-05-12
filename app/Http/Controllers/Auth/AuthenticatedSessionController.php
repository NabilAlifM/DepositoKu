<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        // Simpan bank_id di session jika ada
        if ($request->has('bank_id')) {
            session(['intended_bank_id' => $request->bank_id]);
        }
        
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    $user = Auth::user();

    // 🔹 PRIORITAS: jika ada intended bank (hanya untuk user biasa)
    if (session()->has('intended_bank_id') && $user->role !== 'admin') {
        $bankId = session('intended_bank_id');
        session()->forget('intended_bank_id');

        return redirect()->route('simulations.index')
            ->with('auto_simulate', [
                'bank_id' => $bankId,
                'nominal_deposito' => 10000000,
                'jangka_waktu_bulan' => 12
            ]);
    }

    // 🔹 Redirect berdasarkan role
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // 🔹 Default user
    return redirect()->route('simulations.index');
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}