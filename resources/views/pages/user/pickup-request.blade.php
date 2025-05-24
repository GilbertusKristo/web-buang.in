@extends('layouts.user')

@section('title', 'Permintaan Jemput')

@section('header', 'Permintaan Jemput')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Permintaan Jemput</h1>
        <p class="text-gray-600">Kelola permintaan jemput sampah Anda</p>
    </div>
    <a href="{{ route('user.pickup.form') }}" class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors">
        <i class="fas fa-plus mr-2"></i> Buat Permintaan
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="p-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">

Saya telah membuat implementasi untuk menghubungkan form permintaan jemput dan laporan sampah dengan database sesuai dengan struktur SQL yang Anda berikan. Berikut adalah penjelasan dari kode yang telah saya buat:

### 1. Model
- **PickupRequest.php**: Model untuk tabel pickup_requests dengan fillable fields sesuai struktur database
- **Report.php**: Model untuk tabel reports dengan fillable fields sesuai struktur database

### 2. Controller
- **UserController.php**: Controller yang menangani semua fungsi user termasuk:
  - `storePickupRequest()`: Menyimpan data permintaan jemput ke database
  - `storeReport()`: Menyimpan data laporan sampah ke database
  - `getPickupRequests()`: Mengambil semua permintaan jemput user
  - `getReports()`: Mengambil semua laporan user
  - `getHistory()`: Mengambil riwayat aktivitas user (permintaan jemput dan laporan)
  - `getDashboardData()`: Mengambil data untuk dashboard user

### 3. Routes
- Menambahkan middleware auth pada semua route user
- Mengubah route dashboard untuk mengambil data dari controller
- Menambahkan route untuk melihat permintaan jemput dan laporan

### 4. Views
- **dashboard.blade.php**: Menampilkan data dari database (total sampah, permintaan, laporan, poin)
- **pickup-form.blade.php**: Form permintaan jemput dengan validasi dan peta
- **report-form.blade.php**: Form laporan sampah dengan validasi, upload foto, dan peta
- **history.blade.php**: Menampilkan riwayat aktivitas user dengan filter dan modal detail

### Fitur yang Diimplementasikan:
1. **Validasi Form**: Validasi input pada form permintaan jemput dan laporan
2. **Upload Foto**: Untuk laporan sampah
3. **Peta Interaktif**: Menggunakan Leaflet.js untuk menentukan lokasi
4. **Perhitungan Poin**: Berdasarkan berat sampah dan jumlah laporan
5. **Filter Riwayat**: Filter berdasarkan jenis aktivitas (permintaan jemput atau laporan)
6. **Detail Modal**: Melihat detail permintaan jemput dan laporan

### Langkah Selanjutnya:
1. Implementasikan fungsi untuk membatalkan permintaan jemput
2. Tambahkan notifikasi real-time
3. Implementasikan tracking status permintaan jemput
4. Tambahkan fitur untuk melihat lokasi pada peta secara real-time
5. Implementasikan dashboard admin untuk mengelola permintaan jemput dan laporan

Dengan implementasi ini, aplikasi Buang.in Anda sekarang dapat menyimpan data permintaan jemput dan laporan sampah ke database, serta menampilkan data tersebut di dashboard dan halaman riwayat.
