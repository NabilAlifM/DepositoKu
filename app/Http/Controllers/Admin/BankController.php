<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BankController extends Controller
{
    /**
     * Display a listing of banks with search/filter
     */
    public function index(Request $request)
    {
        $query = Bank::query();

        // Search by nama bank or PT
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_bank', 'like', '%' . $search . '%')
                  ->orWhere('pt', 'like', '%' . $search . '%');
            });
        }

        // Filter by suku bunga minimum
        if ($request->filled('bunga_min')) {
            $query->where('suku_bunga_dasar', '>=', $request->bunga_min);
        }

        // Filter by suku bunga maximum
        if ($request->filled('bunga_max')) {
            $query->where('suku_bunga_dasar', '<=', $request->bunga_max);
        }

        // Order and paginate with query string preserved
        $banks = $query->orderBy('nama_bank', 'asc')
                       ->paginate(15)
                       ->withQueryString();
        
        return view('admin.banks.index', compact('banks'));
    }

    /**
     * Show the form for creating a new bank
     */
    public function create()
    {
        return view('admin.banks.create');
    }

    /**
     * Store a newly created bank
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bank' => 'required|string|max:50|unique:banks',
            'pt' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color_primary' => 'required|string|max:7',
            'color_secondary' => 'required|string|max:7',
            'suku_bunga_dasar' => 'required|numeric|min:0|max:100',
        ]);

        // Upload logo jika ada
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = strtolower(str_replace(' ', '', $validated['nama_bank'])) . '.' . $file->getClientOriginalExtension();
            
            // Simpan ke public/images/banks/
            $file->move(public_path('images/banks'), $filename);
            $validated['logo_url'] = 'images/banks/' . $filename;
        }

        Bank::create($validated);

        return redirect()->route('admin.banks.index')
            ->with('success', 'Bank berhasil ditambahkan');
    }

    /**
     * Show the form for editing bank
     */
    public function edit(Bank $bank)
    {
        return view('admin.banks.edit', compact('bank'));
    }

    /**
     * Update the specified bank
     */
    public function update(Request $request, Bank $bank)
    {
        $validated = $request->validate([
            'nama_bank' => 'required|string|max:50|unique:banks,nama_bank,' . $bank->bank_id . ',bank_id',
            'pt' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color_primary' => 'required|string|max:7',
            'color_secondary' => 'required|string|max:7',
            'suku_bunga_dasar' => 'required|numeric|min:0|max:100',
        ]);

        // Upload logo baru jika ada
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($bank->logo_url && file_exists(public_path($bank->logo_url))) {
                @unlink(public_path($bank->logo_url));
            }
            
            $file = $request->file('logo');
            $filename = strtolower(str_replace(' ', '', $validated['nama_bank'])) . '.' . $file->getClientOriginalExtension();
            
            // Simpan ke public/images/banks/
            $file->move(public_path('images/banks'), $filename);
            $validated['logo_url'] = 'images/banks/' . $filename;
        }

        $bank->update($validated);

        return redirect()->route('admin.banks.index')
            ->with('success', 'Bank berhasil diupdate');
    }

    /**
     * Remove the specified bank
     */
    public function destroy(Bank $bank)
    {
        // Hapus logo jika ada
        if ($bank->logo_url && file_exists(public_path($bank->logo_url))) {
            @unlink(public_path($bank->logo_url));
        }

        $bank->delete();

        return redirect()->route('admin.banks.index')
            ->with('success', 'Bank berhasil dihapus');
    }
}