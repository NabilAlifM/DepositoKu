<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Halaman Database Bank (Public)
     */
    public function databaseBank(Request $request)
    {
        $query = Bank::query();
        
        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_bank', 'LIKE', '%' . $request->search . '%');
        }
        
        // Sort by interest rate
        if ($request->has('sort')) {
            if ($request->sort == 'highest') {
                $query->orderBy('suku_bunga_dasar', 'desc');
            } elseif ($request->sort == 'lowest') {
                $query->orderBy('suku_bunga_dasar', 'asc');
            }
        } else {
            $query->orderBy('nama_bank', 'asc');
        }
        
        $banks = $query->get();
        
        return view('public.database-bank', compact('banks'));
    }

    /**
     * Halaman Edukasi Deposito (Public)
     */
    public function edukasi()
    {
        $articles = [
            [
                'category' => 'Panduan Dasar',
                'title' => 'Apa Itu Deposito dan Bagaimana Cara Kerjanya?',
                'description' => 'Pelajari dasar-dasar deposito, manfaatnya, dan bagaimana cara kerja investasi yang aman ini.',
                'image' => 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=400',
                'icon' => 'book'
            ],
            [
                'category' => 'Strategi',
                'title' => 'Bunga Sederhana vs Bunga Majemuk: Mana yang Lebih Menguntungkan?',
                'description' => 'Pahami perbedaan antara bunga sederhana dan majemuk untuk memaksimalkan keuntungan deposito Anda.',
                'image' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=400',
                'icon' => 'chart'
            ],
            [
                'category' => 'Keamanan',
                'title' => 'Keamanan Deposito: LPS dan Perlindungan Dana Anda',
                'description' => 'Ketahui bagaimana LPS melindungi dana deposito Anda hingga Rp 2 miliar per nasabah.',
                'image' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=400',
                'icon' => 'shield'
            ],
            [
                'category' => 'Pajak',
                'title' => 'Cara Menghitung Pajak Bunga Deposito',
                'description' => 'Panduan lengkap menghitung pajak bunga deposito dan strategi optimalisasi return.',
                'image' => 'https://images.unsplash.com/photo-1554224154-26032ffc0d07?w=400',
                'icon' => 'calculator'
            ]
        ];
        
        return view('public.edukasi', compact('articles'));
    }
}