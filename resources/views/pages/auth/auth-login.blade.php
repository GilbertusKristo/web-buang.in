<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Buang.in</title>
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
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <a href="{{ url('/') }}" class="absolute top-6 left-6 flex items-center text-gray-700 hover:text-primary-500 transition duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke Beranda
    </a>
    
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all hover:shadow-2xl">
            <div class="p-8">
                <div class="flex justify-center mb-8">
                    <img src="{{ asset('img/buangin.png') }}" alt="Buang.in" class="h-20 animate-float">
                </div>
                
                <h1 class="text-2xl font-bold text-gray-800 text-center mb-2">Masuk Ke Akun Anda</h1>
                <p class="text-gray-500 text-center mb-8">Masukkan Email dan Password anda untuk melanjutkan</p>
                
                <form method="POST" action="{{ route('web.auth.login') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukkan email anda" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200" />
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password anda" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200" />
                        <div class="flex justify-end mt-2">
                            <a href="#" class="text-sm text-primary-600 hover:text-primary-500">Lupa Password?</a>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full gradient-bg text-white py-3 px-4 rounded-xl font-medium hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-lg">
                        Masuk
                    </button>
                    @if (session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded-xl mb-4 text-center">
        {{ session('error') }}
    </div>
@endif

                </form>
                
                <div class="text-center mt-8">
                    <p class="text-gray-600">
                        Belum punya akun? 
                        <a href="{{ route('auth.register.form') }}" class="text-primary-600 font-medium hover:text-primary-500">
                            Daftar sekarang
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
