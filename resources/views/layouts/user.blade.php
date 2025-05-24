<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Buang.in</title>
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
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .sidebar-active {
            background-color: rgba(22, 179, 100, 0.1);
            color: #16B364;
            border-left: 3px solid #16B364;
        }
    </style>
    @yield('head')
</head>

<body class="bg-gray-50 flex h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-white border-r border-gray-200 flex-shrink-0 hidden md:block">
        <div class="p-4 border-b flex justify-center">
            <img src="{{ asset('img/buangin.png') }}" alt="Buang.in" class="h-12">
        </div>
        
        <div class="py-4">
            <nav>
                <a href="{{ route('user.dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors {{ request()->routeIs('user.dashboard') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-home w-5 mr-3 text-center"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('user.pickup.form') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors {{ request()->routeIs('user.pickup.form') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-truck w-5 mr-3 text-center"></i>
                    <span>Permintaan Jemput</span>
                </a>
                
                <a href="{{ route('user.report.form') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors {{ request()->routeIs('user.report.form') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-flag w-5 mr-3 text-center"></i>
                    <span>Laporan Sampah</span>
                </a>
                
                <a href="{{ route('user.map') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors {{ request()->routeIs('user.map') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-map-marker-alt w-5 mr-3 text-center"></i>
                    <span>Peta Lokasi</span>
                </a>
                
                <a href="{{ route('user.waste.sell.form') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors {{ request()->routeIs('user.waste.sell.form') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-recycle w-5 mr-3 text-center"></i>
                    <span>Jual Sampah</span>
                </a>
                
                <a href="{{ route('user.history') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors {{ request()->routeIs('user.history') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-history w-5 mr-3 text-center"></i>
                    <span>Riwayat</span>
                </a>
            </nav>
        </div>
        
        <div class="absolute bottom-0 w-64 border-t border-gray-200 p-4">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mr-3">
                    <i class="fas fa-user"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-800">{{ Auth::user()->name ?? 'User' }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                </div>
            </div>
            
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center text-gray-700 hover:text-primary-600 transition-colors">
                <i class="fas fa-sign-out-alt mr-2"></i>
                <span>Keluar</span>
            </a>
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>
    
    <!-- Mobile Header -->
    <div class="md:hidden fixed top-0 left-0 right-0 bg-white border-b border-gray-200 z-10">
        <div class="flex items-center justify-between p-4">
            <img src="{{ asset('img/buangin.png') }}" alt="Buang.in" class="h-8">
            
            <button id="mobile-menu-button" class="text-gray-700">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden bg-white border-b border-gray-200 pb-4">
            <nav class="px-4">
                <a href="{{ route('user.dashboard') }}" class="block py-2 text-gray-700 hover:text-primary-600 {{ request()->routeIs('user.dashboard') ? 'text-primary-600 font-medium' : '' }}">
                    <i class="fas fa-home mr-2"></i> Dashboard
                </a>
                
                <a href="{{ route('user.pickup.form') }}" class="block py-2 text-gray-700 hover:text-primary-600 {{ request()->routeIs('user.pickup.form') ? 'text-primary-600 font-medium' : '' }}">
                    <i class="fas fa-truck mr-2"></i> Permintaan Jemput
                </a>
                
                <a href="{{ route('user.report.form') }}" class="block py-2 text-gray-700 hover:text-primary-600 {{ request()->routeIs('user.report.form') ? 'text-primary-600 font-medium' : '' }}">
                    <i class="fas fa-flag mr-2"></i> Laporan Sampah
                </a>
                
                <a href="{{ route('user.map') }}" class="block py-2 text-gray-700 hover:text-primary-600 {{ request()->routeIs('user.map') ? 'text-primary-600 font-medium' : '' }}">
                    <i class="fas fa-map-marker-alt mr-2"></i> Peta Lokasi
                </a>
                
                <a href="{{ route('user.waste.sell.form') }}" class="block py-2 text-gray-700 hover:text-primary-600 {{ request()->routeIs('user.waste.sell.form') ? 'text-primary-600 font-medium' : '' }}">
                    <i class="fas fa-recycle mr-2"></i> Jual Sampah
                </a>
                
                <a href="{{ route('user.history') }}" class="block py-2 text-gray-700 hover:text-primary-600 {{ request()->routeIs('user.history') ? 'text-primary-600 font-medium' : '' }}">
                    <i class="fas fa-history mr-2"></i> Riwayat
                </a>
                
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block py-2 text-gray-700 hover:text-primary-600">
                    <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                </a>
            </nav>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white border-b border-gray-200 p-4 hidden md:block">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h1>
                
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-bell"></i>
                        </button>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span>
                    </div>
                    
                    <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
        </header>
        
        <main class="flex-1 overflow-y-auto p-4 md:p-6 mt-16 md:mt-0">
            @yield('content')
        </main>
    </div>
    
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
    
    @yield('scripts')
</body>
</html>
