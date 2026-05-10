# 🏦 DepositoKu

**DepositoKu** adalah platform edukasi dan simulasi investasi deposito yang membantu pengguna merencanakan keuangan mereka dengan lebih baik. Website ini memungkinkan pengguna untuk membandingkan suku bunga dari berbagai bank dan menghitung proyeksi keuntungan deposito secara akurat dan transparan.

---

## ✨ Fitur Utama (Key-Driven Features)

* **🧮 Simulasi Deposito Cerdas:** Hitung proyeksi keuntungan berdasarkan nominal, jangka waktu (tenor), dan suku bunga bank yang dipilih. Sistem otomatis menghitung estimasi bunga yang diterima dan total saldo akhir.
* **🏢 Direktori Bank Lengkap:** Jelajahi berbagai pilihan bank beserta informasi *suku bunga dasar* (base rate) terkini yang ditawarkan.
* **📖 Artikel & Literasi Finansial:** Tingkatkan pemahaman tentang investasi, deposito, dan perencanaan keuangan melalui kumpulan artikel informatif yang terintegrasi.
* **🔐 Manajemen Akun:** Pengguna dapat mendaftar dan masuk ke dalam sistem untuk menyimpan riwayat simulasi yang telah dilakukan secara aman.

---

## 🚀 Keunggulan Fitur

* **Antarmuka Intuitif:** Desain UI/UX yang modern, bersih, dan responsif, memastikan kenyamanan penggunaan di berbagai ukuran layar (Mobile, Tablet, Desktop).
* **Perbandingan Mudah:** Memudahkan pengguna membandingkan potensi keuntungan antar bank dalam satu tempat tanpa harus mengunjungi situs masing-masing bank.
* **Akurasi Perhitungan:** Menggunakan formula perhitungan deposito standar untuk memberikan estimasi imbal hasil yang mendekati realita.
* **Pengalaman Terpersonalisasi:** Dengan fitur manajemen pengguna (User/Auth), setiap orang memiliki rekam jejak simulasi finansial mereka sendiri.

---

## 💡 Kebermanfaatan

1. **Untuk Calon Investor / Masyarakat Umum:** Membantu pemula untuk memahami skema imbal hasil deposito sebelum menyetorkan uangnya ke instansi perbankan.
2. **Alat Perencanaan Keuangan (Financial Planning):** Menjadi *tools* praktis bagi siapa saja yang sedang merencanakan target keuangan jangka pendek hingga menengah.
3. **Edukasi Inklusif:** Mendorong dan meningkatkan literasi keuangan masyarakat Indonesia melalui edukasi instrumen investasi minim risiko.

---

## 🛠️ Implementasi Teknis & Tech Stack

Aplikasi ini dikembangkan menggunakan arsitektur *Modern Monolith* yang kokoh, berfokus pada kecepatan pengembangan, performa rendering, dan keamanan.

**Tech Stack:**
* **Backend:** [Laravel 11](https://laravel.com/) (PHP 8.2+) - *Framework backend tangguh untuk routing, session, dan logika bisnis.*
* **Frontend UI:** [Tailwind CSS 3](https://tailwindcss.com/) & [Flowbite](https://flowbite.com/) - *Utility-first CSS framework untuk styling komponen UI yang cepat dan konsisten.*
* **Interaktivitas:** [Alpine.js](https://alpinejs.dev/) - *Lightweight JavaScript framework untuk mengelola state UI di sisi klien (dropdown, modal).*
* **Database:** Relasional DB (MySQL / PostgreSQL / SQLite) via Eloquent ORM.
* **Build Tool:** [Vite](https://vitejs.dev/) - *Frontend tooling masa kini untuk Hot Module Replacement (HMR) dan asset bundling.*
* **Authentication:** Laravel Breeze - *Starter kit scaffolding autentikasi yang aman.*

**Implementasi Teknis:**
* **Arsitektur MVC:** Memisahkan dengan jelas antara pengolahan data (Model), antarmuka (View), dan logika aplikasi (Controller).
* **Eloquent Relationships:** Mengelola integritas relasi antar entitas secara efisien (Misal: Relasi *One-to-Many* antara entitas `Bank` dan `Simulation`, serta `User` dan `Simulation`).
* **Responsive & Mobile-First:** Antarmuka dibangun dengan kelas utilitas Tailwind memastikan layout dapat beradaptasi secara dinamis terhadap ukuran layar pengguna (responsiveness).

---

## ⚙️ Cara Instalasi (Local Development)

Jika Anda ingin menjalankan dan mengembangkan proyek ini secara lokal, ikuti langkah-langkah berikut:

1. **Clone repository ini:**
   ```bash
   git clone <repo-url>
   cd db_deposito_nabil
   ```

2. **Install dependensi PHP (Composer) dan JavaScript (NPM):**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment:**
   Salin file `.env.example` menjadi `.env` dan hasilkan application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *(Pastikan pengaturan koneksi database di file `.env` sudah sesuai dengan environment lokal Anda)*

4. **Jalankan Migrasi Database:**
   ```bash
   php artisan migrate
   ```

5. **Jalankan Development Server:**
   Anda dapat menggunakan perintah bawaan Laravel & Vite:
   ```bash
   npm run dev
   # (di tab terminal baru)
   php artisan serve
   ```
   *Atau jalankan secara paralel dengan:* `npm run dev` (karena package.json sudah diatur menggunakan concurrently).
