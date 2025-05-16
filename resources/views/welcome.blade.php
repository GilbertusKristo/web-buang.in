<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buang.in - Kelola Sampah Dan Selamatkan Bumi Kita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#EDFCF4',
                            100: '#D3F9E5',
                            200: '#A7F3CC',
                            300: '#6EEAB0',
                            400: '#38D990',
                            500: '#16B364', // Rich green
                            600: '#099250',
                            700: '#087443',
                            800: '#095C37',
                            900: '#084C2E',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #16B364 0%, #059669 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .waste-icon {
            transition: all 0.3s ease;
        }
        
        .waste-card:hover .waste-icon {
            transform: scale(1.1);
        }
        
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2316B364' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="antialiased">
    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <a href="/" class="font-bold text-xl text-primary-500">
                    <img src="{{ asset('img/buangin.png') }}" alt="Buang.in" class="h-10">
                </a>
                <nav class="hidden md:flex space-x-6">
                    <a href="#beranda" class="hover:text-primary-500 transition duration-300">Beranda</a>
                    <a href="#tentang" class="hover:text-primary-500 transition duration-300">Tentang Kami</a>
                    <a href="#layanan" class="hover:text-primary-500 transition duration-300">Layanan</a>
                    <a href="#kontak" class="hover:text-primary-500 transition duration-300">Kontak</a>
                </nav>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('auth.login.form') }}" class="text-gray-700 hover:text-primary-500 transition duration-300">Masuk</a>
                    <a href="{{ route('auth.register.form') }}" class="px-4 py-2 bg-primary-500 text-white font-semibold rounded-lg hover:bg-primary-600 transition duration-300">Daftar</a>
                </div>
                <button id="mobile-menu-button" class="md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="bg-white shadow-md py-4 px-6">
                <a href="#beranda" class="block py-2 hover:text-primary-500 transition duration-300">Beranda</a>
                <a href="#tentang" class="block py-2 hover:text-primary-500 transition duration-300">Tentang Kami</a>
                <a href="#layanan" class="block py-2 hover:text-primary-500 transition duration-300">Layanan</a>
                <a href="#kontak" class="block py-2 hover:text-primary-500 transition duration-300">Kontak</a>
                <div class="mt-4">
                    <a href="{{ route('auth.login.form') }}" class="block py-2 text-gray-700 hover:text-primary-500 transition duration-300">Masuk</a>
                    <a href="{{ route('auth.register.form') }}" class="block py-2 bg-primary-500 text-white font-semibold rounded-lg hover:bg-primary-600 transition duration-300">Daftar</a>
                </div>
            </div>
        </div>
    </header>

<!-- Hero Section -->
<section id="beranda" class="hero-pattern py-20 md:py-28">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 mb-10 md:mb-0" data-aos="fade-right" data-aos-duration="1000">
            <span class="inline-block px-3 py-1 bg-primary-100 text-primary-600 rounded-full text-sm font-semibold mb-6">
                Platform Pengelolaan Sampah #1
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-800 leading-tight mb-6">
                Kelola Sampah Dan <span class="text-primary-500">Selamatkan</span> Bumi Kita
            </h1>
            <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                Buang.in membantu Anda mengelola sampah dengan cara yang ramah lingkungan. Bergabunglah dengan kami untuk menciptakan lingkungan yang lebih bersih dan berkelanjutan.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('auth.register.form') }}" class="px-8 py-4 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition duration-300 shadow-xl hover:shadow-primary-500/30 transform hover:-translate-y-1">
                    Mulai Sekarang
                </a>
                <a href="#layanan" class="px-8 py-4 bg-white text-gray-700 font-semibold rounded-xl border-2 border-gray-200 hover:border-primary-500 hover:text-primary-500 transition duration-300 shadow-lg hover:shadow-lg transform hover:-translate-y-1">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
        <div class="md:w-1/2 flex justify-center" data-aos="fade-left" data-aos-duration="1000">
            <div class="relative">
                <div class="absolute inset-0 bg-primary-300 rounded-full opacity-20 blur-3xl"></div>
                <img src="{{ asset('img/buangin.png') }}" alt="Buang.in Logo" class="relative z-10 w-64 md:w-96 h-auto animate-float">
            </div>
        </div>
    </div>
</section>

<!-- Bersama Menciptakan Perubahan Section -->
<section id="tentang" class="py-20 md:py-28 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
            <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-600 rounded-full text-sm font-semibold mb-4">
                Tentang Kami
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-6">Bersama Menciptakan Perubahan</h2>
            <p class="text-gray-600 max-w-3xl mx-auto text-lg">
                Buang.in adalah platform yang menghubungkan masyarakat dengan pengepul sampah untuk menciptakan lingkungan yang lebih bersih dan berkelanjutan melalui pengelolaan sampah yang tepat.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 border border-gray-100 card-hover" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
                <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mb-6 text-primary-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Mengurangi Limbah Rumah</h3>
                <p class="text-gray-600 leading-relaxed">
                    Membantu mengurangi limbah rumah tangga dengan cara yang efektif dan ramah lingkungan melalui sistem pengelolaan sampah yang terorganisir.
                </p>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 border border-gray-100 card-hover" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mb-6 text-primary-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Ekonomi Sirkular</h3>
                <p class="text-gray-600 leading-relaxed">
                    Mendorong ekonomi sirkular dengan mengubah sampah menjadi sumber daya yang bernilai ekonomi dan dapat digunakan kembali.
                </p>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 border border-gray-100 card-hover" data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
                <div class="w-16 h-16 bg-primary-100 rounded-2xl flex items-center justify-center mb-6 text-primary-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Mengurangi Emisi Karbon</h3>
                <p class="text-gray-600 leading-relaxed">
                    Berkontribusi dalam mengurangi emisi karbon melalui pengelolaan sampah yang tepat dan mendukung upaya pelestarian lingkungan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Bagaimana Buang.in Bekerja Section -->
<section id="layanan" class="py-20 md:py-28 bg-primary-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
            <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-600 rounded-full text-sm font-semibold mb-4">
                Proses
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-6">Bagaimana Buang.in Bekerja?</h2>
            <p class="text-gray-600 max-w-3xl mx-auto text-lg">
                Proses sederhana untuk membantu Anda mengelola sampah dengan cara yang ramah lingkungan dan menguntungkan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 text-center card-hover" data-aos="fade-right" data-aos-duration="1000">
                <div class="w-24 h-24 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Kumpulkan Sampah</h3>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Kumpulkan sampah yang dapat didaur ulang seperti plastik, kertas, logam, dan kaca di rumah Anda.
                </p>
                <a href="{{ route('auth.register.form') }}" class="inline-block px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition duration-300 shadow-lg hover:shadow-primary-500/30 transform hover:-translate-y-1">
                    Mulai Sekarang
                </a>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 text-center card-hover" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <div class="w-24 h-24 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Jual Sampah</h3>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Jual sampah Anda melalui aplikasi Buang.in dan dapatkan harga terbaik dari pengepul sampah terdekat.
                </p>
                <a href="{{ route('auth.register.form') }}" class="inline-block px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition duration-300 shadow-lg hover:shadow-primary-500/30 transform hover:-translate-y-1">
                    Daftar Sekarang
                </a>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition duration-500 text-center card-hover" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="400">
                <div class="w-24 h-24 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Terima Pembayaran</h3>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Dapatkan pembayaran langsung ke akun Anda setelah sampah diambil oleh pengepul sampah.
                </p>
                <a href="{{ route('auth.register.form') }}" class="inline-block px-6 py-3 bg-primary-500 text-white font-semibold rounded-xl hover:bg-primary-600 transition duration-300 shadow-lg hover:shadow-primary-500/30 transform hover:-translate-y-1">
                    Gabung Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Solusi Lengkap Section -->
<section class="py-20 md:py-28 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
            <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-600 rounded-full text-sm font-semibold mb-4">
                Layanan
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-6">Solusi Lengkap Untuk Pengelolaan Sampah</h2>
            <p class="text-gray-600 max-w-3xl mx-auto text-lg">
                Buang.in menyediakan berbagai layanan pengelolaan sampah untuk membantu Anda berkontribusi dalam menjaga lingkungan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 border border-gray-100 card-hover" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Layanan Sampah</h3>
                <p class="text-gray-600">
                    Layanan pengambilan sampah langsung dari rumah Anda dengan jadwal yang fleksibel.
                </p>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 border border-gray-100 card-hover" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Peta Sampah</h3>
                <p class="text-gray-600">
                    Temukan lokasi pengepul sampah terdekat di sekitar Anda melalui peta interaktif.
                </p>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 border border-gray-100 card-hover" data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Jadwal Pengambilan</h3>
                <p class="text-gray-600">
                    Atur jadwal pengambilan sampah sesuai dengan kebutuhan Anda dan dapatkan notifikasi.
                </p>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 border border-gray-100 card-hover" data-aos="fade-up" data-aos-delay="400" data-aos-duration="800">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Pengambilan Cepat</h3>
                <p class="text-gray-600">
                    Layanan pengambilan sampah cepat untuk kebutuhan mendesak dengan waktu respons yang cepat.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Mengapa Harus Bergabung Section -->
<section class="py-20 md:py-28 bg-primary-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
            <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-600 rounded-full text-sm font-semibold mb-4">
                Keuntungan
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-6">Mengapa Harus Bergabung?</h2>
            <p class="text-gray-600 max-w-3xl mx-auto text-lg">
                Bergabung dengan Buang.in memberikan banyak keuntungan bagi Anda dan lingkungan. Berikut adalah beberapa alasan mengapa Anda harus bergabung dengan kami.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 border border-gray-100 card-hover" data-aos="flip-left" data-aos-delay="100" data-aos-duration="800">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Pendapatan Tambahan</h3>
                <p class="text-gray-600">
                    Dapatkan pendapatan tambahan dari sampah yang biasanya Anda buang dengan menjualnya melalui platform Buang.in.
                </p>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 border border-gray-100 card-hover" data-aos="flip-left" data-aos-delay="200" data-aos-duration="800">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Lingkungan Bersih</h3>
                <p class="text-gray-600">
                    Berkontribusi dalam menciptakan lingkungan yang lebih bersih dan sehat dengan mengurangi sampah.
                </p>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 border border-gray-100 card-hover" data-aos="flip-left" data-aos-delay="300" data-aos-duration="800">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Edukasi Sampah</h3>
                <p class="text-gray-600">
                    Dapatkan informasi dan edukasi tentang pengelolaan sampah yang benar dan cara mengurangi dampak negatif.
                </p>
            </div>
            
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 border border-gray-100 card-hover" data-aos="flip-left" data-aos-delay="400" data-aos-duration="800">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Komunitas Peduli</h3>
                <p class="text-gray-600">
                    Bergabung dengan komunitas yang peduli terhadap lingkungan dan berbagi pengalaman serta pengetahuan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Jenis Sampah Section -->
<section class="py-20 md:py-28 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
            <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-600 rounded-full text-sm font-semibold mb-4">
                Informasi
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-6">Jenis Sampah Yang Dapat Dijual</h2>
            <p class="text-gray-600 max-w-3xl mx-auto text-lg">
                Berbagai jenis sampah yang dapat dijual melalui platform Buang.in untuk mendapatkan nilai ekonomi.
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-6 gap-6">
            <!-- Plastik -->
            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 text-center waste-card" data-aos="zoom-in" data-aos-delay="100">
                <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4 waste-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.29 7 12 12 20.71 7"></polyline>
                        <line x1="12" y1="22" x2="12" y2="12"></line>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Plastik</h3>
                <p class="text-gray-600 text-sm mt-2">Botol, kantong, wadah</p>
            </div>
            
            <!-- Kertas -->
            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 text-center waste-card" data-aos="zoom-in" data-aos-delay="200">
                <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4 waste-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Kertas</h3>
                <p class="text-gray-600 text-sm mt-2">Koran, majalah, buku</p>
            </div>
            
            <!-- Logam -->
            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 text-center waste-card" data-aos="zoom-in" data-aos-delay="300">
                <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4 waste-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Logam</h3>
                <p class="text-gray-600 text-sm mt-2">Kaleng, besi, aluminium</p>
            </div>
            
            <!-- Kaca -->
            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 text-center waste-card" data-aos="zoom-in" data-aos-delay="400">
                <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4 waste-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 21h12a2 2 0 0 0 2-2v-2H10v2a2 2 0 0 1-2 2zm14-10v2a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-2zM4 5v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V5c0-1.1-.9-2-2-2H6a2 2 0 0 0-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Kaca</h3>
                <p class="text-gray-600 text-sm mt-2">Botol, gelas, wadah</p>
            </div>
            
            <!-- Elektronik -->
            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 text-center waste-card" data-aos="zoom-in" data-aos-delay="500">
                <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4 waste-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                        <rect x="9" y="9" width="6" height="6"></rect>
                        <line x1="9" y1="1" x2="9" y2="4"></line>
                        <line x1="15" y1="1" x2="15" y2="4"></line>
                        <line x1="9" y1="20" x2="9" y2="23"></line>
                        <line x1="15" y1="20" x2="15" y2="23"></line>
                        <line x1="20" y1="9" x2="23" y2="9"></line>
                        <line x1="20" y1="14" x2="23" y2="14"></line>
                        <line x1="1" y1="9" x2="4" y2="9"></line>
                        <line x1="1" y1="14" x2="4" y2="14"></line>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Elektronik</h3>
                <p class="text-gray-600 text-sm mt-2">Ponsel, komputer, kabel</p>
            </div>
            
            <!-- Kardus -->
            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-500 text-center waste-card" data-aos="zoom-in" data-aos-delay="600">
                <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4 waste-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Kardus</h3>
                <p class="text-gray-600 text-sm mt-2">Kotak, kemasan, karton</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 md:py-28 gradient-bg text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center" data-aos="fade-up" data-aos-duration="1000">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8">Bergabunglah Dengan Gerakan Peduli Lingkungan</h2>
            <p class="text-white/90 mb-12 text-lg leading-relaxed">
                Jadilah bagian dari solusi untuk mengurangi sampah dan menciptakan lingkungan yang lebih bersih dan sehat. Bergabunglah dengan Buang.in sekarang dan mulai berkontribusi untuk bumi yang lebih baik.
            </p>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="{{ route('auth.register.form') }}" class="px-8 py-4 bg-white text-primary-600 font-semibold rounded-xl hover:bg-gray-100 transition duration-300 shadow-xl hover:shadow-black/10 transform hover:-translate-y-1">
                    Daftar Sekarang
                </a>
                <a href="#kontak" class="px-8 py-4 bg-transparent text-white font-semibold rounded-xl border-2 border-white hover:bg-white/10 transition duration-300 transform hover:-translate-y-1">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer id="kontak" class="bg-white pt-20 pb-6">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-16">
            <div data-aos="fade-right" data-aos-duration="800">
                <img src="{{ asset('img/buangin.png') }}" alt="Buang.in" class="h-12 mb-6">
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Platform pengelolaan sampah yang menghubungkan masyarakat dengan pengepul sampah untuk menciptakan lingkungan yang lebih bersih.
                </p>
                <div class="flex space-x-4">
                    <a href="https://facebook.com" target="_blank" class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-500 hover:bg-primary-500 hover:text-white transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                        </svg>
                    </a>
                    <a href="https://instagram.com" target="_blank" class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-500 hover:bg-primary-500 hover:text-white transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                        </svg>
                    </a>
                    <a href="https://twitter.com" target="_blank" class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-500 hover:bg-primary-500 hover:text-white transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                        </svg>
                    </a>
                </div>
            </div>
            
            <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                <h3 class="text-gray-800 font-bold text-xl mb-6">Perusahaan</h3>
                <ul class="space-y-4">
                    <li><a href="#tentang" class="text-gray-600 hover:text-primary-500 transition duration-300">Tentang Kami</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-primary-500 transition duration-300">Karir</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-primary-500 transition duration-300">Blog</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-primary-500 transition duration-300">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-primary-500 transition duration-300">Syarat dan Ketentuan</a></li>
                </ul>
            </div>
            
            <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <h3 class="text-gray-800 font-bold text-xl mb-6">Layanan</h3>
                <ul class="space-y-4">
                    <li><a href="#layanan" class="text-gray-600 hover:text-primary-500 transition duration-300">Pengambilan Sampah</a></li>
                    <li><a href="#layanan" class="text-gray-600 hover:text-primary-500 transition duration-300">Penjualan Sampah</a></li>
                    <li><a href="#layanan" class="text-gray-600 hover:text-primary-500 transition duration-300">Edukasi Sampah</a></li>
                    <li><a href="#layanan" class="text-gray-600 hover:text-primary-500 transition duration-300">Komunitas</a></li>
                    <li><a href="#layanan" class="text-gray-600 hover:text-primary-500 transition duration-300">Program CSR</a></li>
                </ul>
            </div>
            
            <div data-aos="fade-left" data-aos-duration="800" data-aos-delay="300">
                <h3 class="text-gray-800 font-bold text-xl mb-6">Kontak</h3>
                <ul class="space-y-4">
                    <li class="flex items-center text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href="mailto:info@buangin.id" class="hover:text-primary-500 transition duration-300">info@buangin.id</a>
                    </li>
                    <li class="flex items-center text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <a href="tel:+6281234567890" class="hover:text-primary-500 transition duration-300">+62 812 3456 7890</a>
                    </li>
                    <li class="flex items-start text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 mt-1 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <a href="https://maps.google.com" target="_blank" class="hover:text-primary-500 transition duration-300">Jl. Lingkungan Bersih No. 123, Jakarta</a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-200 pt-8 text-center">
            <p class="text-gray-600">&copy; 2025 Buang.in. Hak Cipta Dilindungi.</p>
        </div>
    </div>
</footer>

<script>
    // Initialize AOS
    AOS.init({
        once: true, // whether animation should happen only once - while scrolling down
        mirror: false, // whether elements should animate out while scrolling past them
    });
    
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
    
    // Close mobile menu when clicking on a link
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.add('hidden');
        });
    });
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Add animation on scroll
    const animateOnScroll = () => {
        const elements = document.querySelectorAll('.card-hover');
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.2;
            
            if (elementPosition < screenPosition) {
                element.classList.add('animate-pulse-slow');
            }
        });
    };
    
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Run once on page load
    
    // Make all buttons functional
    document.querySelectorAll('a[href="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            // Prevent default action for links with "#" href
            e.preventDefault();
            
            // You can add custom functionality here if needed
            console.log('Button clicked:', this.textContent.trim());
            
            // For demonstration purposes, show a notification
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-4 right-4 bg-primary-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-pulse';
            notification.textContent = 'Fitur ini akan segera hadir!';
            document.body.appendChild(notification);
            
            // Remove notification after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        });
    });
</script>
</body>
</html>
