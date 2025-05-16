<<<<<<< HEAD
@extends('layouts.auth')

@section('title', 'Daftar')

@section('main')
<div class="container">
    <div class="auth-card">
        <div class="logo">
            <img src="{{ asset('img/buangin.png') }}" alt="Buang.in">
        </div>

        <h1>Buat Akun Baru</h1>
        <p class="subtitle">Bergabunglah Dengan Kami untuk lingkungan yang lebih baik</p>

        <form method="POST" action="{{ route('web.auth.register') }}" id="registerForm">
            @csrf

            <div class="step" id="step1">
                <div class="step-indicator">
                    <div class="step-circle active"><span>1</span></div>
                    <div class="step-label">Informasi Pribadi</div>
                    <div class="step-circle"><span>2</span></div>
                    <div class="step-label">Keamanan</div>
                </div>

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <button type="button" class="btn btn-primary" onclick="nextStep()">Lanjutkan</button>

                <div class="auth-footer">
                    <p>Sudah Punya Akun? <a href="{{ route('auth.login.form') }}">Masuk</a></p>
                </div>
            </div>

            <div class="step" id="step2" style="display: none;">
                <div class="step-indicator">
                    <div class="step-circle"><span>1</span></div>
                    <div class="step-label">Informasi Pribadi</div>
                    <div class="step-circle active"><span>2</span></div>
                    <div class="step-label">Keamanan</div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-secondary" onclick="prevStep()">Kembali</button>
                    <button type="submit" class="btn btn-primary">Lanjutkan</button>
                </div>

                <div class="auth-footer">
                    <p>Sudah Punya Akun? <a href="{{ route('auth.login.form') }}">Masuk</a></p>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function nextStep() {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
    }

    function prevStep() {
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step1').style.display = 'block';
    }
</script>
@endsection
=======
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Buang.in</title>
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
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2316B364' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #16B364 0%, #099250 100%);
        }
        
        .step-transition {
            transition: all 0.5s ease-in-out;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <a href="{{ url('/') }}" class="absolute top-6 left-6 flex items-center text-gray-700 hover:text-primary-500 transition duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Beranda
    </a>
    
    <div class="w-full max-w-lg">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all hover:shadow-2xl">
            <div class="p-8">
                <div class="flex justify-center mb-8">
                    <img src="{{ asset('img/buangin.png') }}" alt="Buang.in" class="h-20 animate-float">
                </div>
                
                <h1 class="text-2xl font-bold text-gray-800 text-center mb-2">Buat Akun Baru</h1>
                <p class="text-gray-500 text-center mb-8">Bergabunglah Dengan Kami untuk lingkungan yang lebih baik</p>
                
                <form method="POST" action="{{ route('web.auth.register') }}" id="registerForm">
                    @csrf
                    
                    <div class="step step-transition" id="step1">
                        <div class="flex justify-center items-center mb-8">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full gradient-bg flex items-center justify-center text-white font-medium text-lg shadow-lg">1</div>
                                <div class="text-sm font-medium text-gray-700 ml-3">Informasi Pribadi</div>
                            </div>
                            <div class="w-20 h-1 bg-gray-200 mx-3"></div>
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-medium text-lg">2</div>
                                <div class="text-sm text-gray-400 ml-3">Keamanan</div>
                            </div>
                        </div>
                        
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap anda" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200" />
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" id="email" name="email" placeholder="Masukkan email anda" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200" />
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                <input type="tel" id="phone" name="phone" placeholder="Masukkan nomor telepon anda" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200" />
                            </div>
                            
                            <button type="button" onclick="nextStep()" class="w-full gradient-bg text-white py-3 px-4 rounded-xl font-medium hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-lg">
                                Lanjutkan
                            </button>
                            
                            <div class="text-center mt-6">
                                <p class="text-gray-600">
                                    Sudah Punya Akun? 
                                    <a href="{{ route('auth.login.form') }}" class="text-primary-600 font-medium hover:text-primary-500">
                                        Masuk
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="step hidden step-transition" id="step2">
                        <div class="flex justify-center items-center mb-8">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-medium text-lg">1</div>
                                <div class="text-sm text-gray-400 ml-3">Informasi Pribadi</div>
                            </div>
                            <div class="w-20 h-1 gradient-bg mx-3"></div>
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full gradient-bg flex items-center justify-center text-white font-medium text-lg shadow-lg">2</div>
                                <div class="text-sm font-medium text-gray-700 ml-3">Keamanan</div>
                            </div>
                        </div>
                        
                        <div class="space-y-6">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input type="password" id="password" name="password" placeholder="Masukkan password anda" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200" />
                            </div>
                            
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password anda" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200" />
                            </div>
                            
                            <div class="flex gap-4">
                                <button type="button" onclick="prevStep()" class="w-1/2 bg-gray-100 text-gray-700 py-3 px-4 rounded-xl font-medium hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-300">
                                    Kembali
                                </button>
                                <button type="submit" class="w-1/2 gradient-bg text-white py-3 px-4 rounded-xl font-medium hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-lg">
                                    Daftar Sekarang
                                </button>
                            </div>
                            
                            <div class="text-center mt-6">
                                <p class="text-gray-600">
                                    Sudah Punya Akun? 
                                    <a href="{{ route('auth.login.form') }}" class="text-primary-600 font-medium hover:text-primary-500">
                                        Masuk
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function nextStep() {
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
            
            // Add animation
            setTimeout(() => {
                document.getElementById('step2').classList.add('opacity-100');
            }, 50);
        }
        
        function prevStep() {
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step1').classList.remove('hidden');
            
            // Add animation
            setTimeout(() => {
                document.getElementById('step1').classList.add('opacity-100');
            }, 50);
        }
    </script>
</body>
</html>
>>>>>>> 515a80e (update landing page)
