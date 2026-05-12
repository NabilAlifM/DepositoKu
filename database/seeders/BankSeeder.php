<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('banks')->insert([
            [
                'nama_bank' => 'Bank Mandiri',
                'logo_url' => '/images/banks/mandiri.png',
                'color_primary' => '#003D7A',
                'color_secondary' => '#0066CC',
                'suku_bunga_dasar' => 3.75,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_bank' => 'Bank BRI',
                'logo_url' => '/images/banks/bri.png',
                'color_primary' => '#003D7A',
                'color_secondary' => '#0066CC',
                'suku_bunga_dasar' => 4.25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_bank' => 'Bank BCA',
                'logo_url' => '/images/banks/bca.png',
                'color_primary' => '#003D7A',
                'color_secondary' => '#0066CC',
                'suku_bunga_dasar' => 3.00,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}