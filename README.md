# SIAkad - SISTEM INFORMASI AKADEMIK
SIAkad adalah aplikasi berbasis web yang dirancang untuk mengelola data mahasiswa secara efisien serta menyajikan laporan akademik melalui visualisasi data yang interaktif. Aplikasi ini dikembangkan sebagai bagian dari tugas Challenge of The Day (CoTD) untuk mempermudah pemantauan distribusi mahasiswa di lingkungan kampus.

# FITUR UTAMA 
Aplikasi ini mencakup fungsionalitas manajemen data dan pelaporan sebagai berikut:

Manajemen Mahasiswa (CRUD): Pengelolaan data lengkap mahasiswa meliputi NPM, Nama, Email, Program Studi, Angkatan, Status (Aktif/Cuti/Lulus), dan Gender.

Dashboard Reporting Interaktif: Visualisasi data menggunakan 4 jenis grafik untuk mendukung pengambilan keputusan:
1. Bar Chart: Menampilkan jumlah mahasiswa per Program Studi.
2. Line Chart: Menampilkan tren pertumbuhan mahasiswa per Angkatan.
3. Bar/Line Chart: Menampilkan tingkat kelulusan mahasiswa per Angkatan.
4. Pie Chart: Menampilkan rasio gender mahasiswa (Laki-laki & Perempuan).

# Arsitektur Singkat
1. routes/web.php mendefinisikan resource route student.
2. app/Http/Controllers/StudentController.php menangani:
	- CRUD mahasiswa.
	- Query agregasi untuk kebutuhan chart.
3. app/Models/Student.php sebagai model Eloquent tabel students.
4. resources/views/student/index.blade.php menampilkan tabel dan inisialisasi Chart.js.

# TECH STACK
Teknologi yang digunakan dalam pengembangan proyek ini adalah:
1. Backend: Laravel 13.8.0 (PHP 8.3.30) & Eloquent ORM dan Query Builder
2. Frontend: Tailwind CSS (Styling), Alpine.js (Interaktivitas UI), Chart.js (CDN: https://cdn.jsdelivr.net/npm/chart.js), & Blade templating
3. Database: SQLite / MySQL
4. Build Tools : Vite 8 & laravel-vite-plugin 3
5. Development Tools : PHPUnit 12, Laravel Pint, & Laravel Pail

# Struktur Data Mahasiswa
Tabel students mencakup kolom inti berikut:
1. npm (unik)
2. name
3. email
4. prodi
5. angkatan
6. status (aktif, cuti, lulus)
7. gender
8. phone (opsional)

# PANDUAN INSTALASI
1. Clone repository:
git clone [https://github.com/DarrenAlfarezel78/COTD-SIAkadlaravel-academic-reporting-kelompok6.git]

2. Install dependensi:
composer install && npm install

3. Setup environment:
Salin file .env.example menjadi .env, lalu jalankan:
php artisan key:generate

4. Migrasi Database:
php artisan migrate

5. Jalankan aplikasi:
npm run dev
php artisan serve

# Catatan Pengembangan

1. Data chart dihitung di sisi backend pada method index() di StudentController.
2. Chart dirender di resources/views/student/index.blade.php.
3. Untuk deployment production, jalankan npm run build agar aset frontend terkompilasi ke public/build.

# Lisensi
Project ini menggunakan lisensi MIT.