@extends('layouts.user')

@section('title', 'Peta Lokasi')

@section('header', 'Peta Lokasi')

@section('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<style>
    #map {
        height: 500px;
        width: 100%;
        border-radius: 0.75rem;
    }
</style>
@endsection

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-6">
    <div class="border-b border-gray-200 px-4 py-3 flex justify-between items-center">
        <h2 class="font-semibold text-gray-800">Peta Lokasi</h2>
        
        <div class="flex items-center">
            <div class="relative">
                <input type="text" placeholder="Cari lokasi..." class="w-64 px-4 py-2 pr-10 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            
            <button class="ml-2 bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
        </div>
    </div>
    
    <div class="p-4">
        <div id="map"></div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden p-4">
        <div class="flex items-center mb-3">
            <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 mr-3">
                <i class="fas fa-trash-alt"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">Tumpukan Sampah Plastik</h3>
                <p class="text-xs text-gray-500">Jl. Merdeka No. 123</p>
            </div>
        </div>
        <p class="text-sm text-gray-600 mb-3">Tumpukan sampah plastik yang belum diangkut selama beberapa hari.</p>
        <a href="#" class="text-primary-600 text-sm font-medium hover:text-primary-700">
            Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
    
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden p-4">
        <div class="flex items-center mb-3">
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                <i class="fas fa-recycle"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">Tempat Daur Ulang</h3>
                <p class="text-xs text-gray-500">Jl. Sudirman No. 45</p>
            </div>
        </div>
        <p class="text-sm text-gray-600 mb-3">Tempat daur ulang untuk sampah plastik, kertas, dan elektronik.</p>
        <a href="#" class="text-primary-600 text-sm font-medium hover:text-primary-700">
            Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
    
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden p-4">
        <div class="flex items-center mb-3">
            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-3">
                <i class="fas fa-truck"></i>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800">Tempat Pengumpulan</h3>
                <p class="text-xs text-gray-500">Jl. Gatot Subroto No. 78</p>
            </div>
        </div>
        <p class="text-sm text-gray-600 mb-3">Tempat pengumpulan sampah organik dan anorganik.</p>
        <a href="#" class="text-primary-600 text-sm font-medium hover:text-primary-700">
            Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Initialize map
    const map = L.map('map').setView([-6.200000, 106.816666], 13);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    // Add markers
    const yellowIcon = L.divIcon({
        className: 'custom-div-icon',
        html: "<div style='background-color: #FEF3C7; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center;'><i class='fas fa-trash-alt' style='color: #D97706;'></i></div>",
        iconSize: [30, 30],
        iconAnchor: [15, 15]
    });
    
    const blueIcon = L.divIcon({
        className: 'custom-div-icon',
        html: "<div style='background-color: #DBEAFE; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center;'><i class='fas fa-recycle' style='color: #2563EB;'></i></div>",
        iconSize: [30, 30],
        iconAnchor: [15, 15]
    });
    
    const greenIcon = L.divIcon({
        className: 'custom-div-icon',
        html: "<div style='background-color: #D1FAE5; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center;'><i class='fas fa-truck' style='color: #059669;'></i></div>",
        iconSize: [30, 30],
        iconAnchor: [15, 15]
    });
    
    L.marker([-6.195000, 106.820000], {icon: yellowIcon}).addTo(map)
        .bindPopup('Tumpukan Sampah Plastik<br>Jl. Merdeka No. 123');
    
    L.marker([-6.205000, 106.810000], {icon: blueIcon}).addTo(map)
        .bindPopup('Tempat Daur Ulang<br>Jl. Sudirman No. 45');
    
    L.marker([-6.190000, 106.830000], {icon: greenIcon}).addTo(map)
        .bindPopup('Tempat Pengumpulan<br>Jl. Gatot Subroto No. 78');
</script>
@endsection
