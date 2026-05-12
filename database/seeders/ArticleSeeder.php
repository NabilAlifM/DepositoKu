<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Apa Itu Deposito dan Bagaimana Cara Kerjanya?',
                'category' => 'Panduan Dasar',
                'description' => 'Pelajari dasar-dasar deposito, manfaatnya, dan bagaimana cara kerja investasi yang aman ini.',
                'content' => 'Deposito adalah produk simpanan di bank yang penarikannya hanya bisa dilakukan setelah jangka waktu tertentu...',
                'image_url' => 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=400&h=300&fit=crop',
                'is_published' => true
            ],
            [
                'title' => 'Bunga Sederhana vs Bunga Majemuk: Mana yang Lebih Menguntungkan?',
                'category' => 'Strategi',
                'description' => 'Pahami perbedaan antara bunga sederhana dan majemuk untuk memaksimalkan keuntungan deposito Anda.',
                'content' => 'Bunga sederhana dihitung hanya dari modal awal, sedangkan bunga majemuk dihitung dari modal plus bunga sebelumnya...',
                'image_url' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=400&h=300&fit=crop',
                'is_published' => true
            ],
            [
                'title' => 'Keamanan Deposito: LPS dan Perlindungan Dana Anda',
                'category' => 'Keamanan',
                'description' => 'Ketahui bagaimana LPS melindungi dana deposito Anda hingga Rp 2 miliar per nasabah.',
                'content' => 'Lembaga Penjamin Simpanan (LPS) menjamin keamanan dana deposito hingga Rp 2 miliar per nasabah per bank...',
                'image_url' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=400&h=300&fit=crop',
                'is_published' => true
            ],
            [
                'title' => 'Cara Menghitung Pajak Bunga Deposito',
                'category' => 'Pajak',
                'description' => 'Panduan lengkap menghitung pajak bunga deposito dan strategi optimalisasi return.',
                'content' => 'Bunga deposito dikenakan pajak sebesar 20% dari bunga yang diterima. Berikut cara menghitungnya...',
                'image_url' => 'https://images.unsplash.com/photo-1554224154-26032ffc0d07?w=400&h=300&fit=crop',
                'is_published' => true
            ]
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}