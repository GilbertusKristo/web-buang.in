@extends('layouts.user')

@section('title', 'Form Permintaan Jemput')

@section('header', 'Form Permintaan Jemput')

@section('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="border-b border-gray-200 bg-gray-50 px-4 py-3">
        <h2 class="font-semibold text-gray-800">Form Permintaan Jemput Sampah</h2>
        <p class="text-sm text-gray-500">Silahkan isi formulir di bawah ini untuk mengajukan permintaan penjemputan sampah</p>
    </div>
    
    <div class="p-6">
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('user.pickup.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ Auth::user()->name ?? old('name') }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone" value="{{ Auth::user()->phone ?? old('phone') }}" placeholder="Contoh: 08123456789" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                </div>
            </div>
            
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                <textarea id="address" name="address" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>{{ old('address') }}</textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi Penjemputan</label>
                <div id="map" class="h-64 bg-gray-200 rounded-lg mb-2 relative"></div>
                <input type="hidden" id="coordinates" name="coordinates" value="{{ old('coordinates', '-6.200000,106.816666') }}">
                <p class="text-xs text-gray-500">Klik pada peta untuk menentukan lokasi atau gunakan tombol "Lokasi Saya"</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="waste_type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Sampah</label>
                    <select id="waste_type" name="waste_type" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                        <option value="" disabled {{ old('waste_type') ? '' : 'selected' }}>Pilih jenis sampah</option>
                        <option value="Organik" {{ old('waste_type') == 'Organik' ? 'selected' : '' }}>Organik</option>
                        <option value="Anorganik" {{ old('waste_type') == 'Anorganik' ? 'selected' : '' }}>Anorganik</option>
                        <option value="Plastik" {{ old('waste_type') == 'Plastik' ? 'selected' : '' }}>Plastik</option>
                        <option value="Kertas" {{ old('waste_type') == 'Kertas' ? 'selected' : '' }}>Kertas</option>
                        <option value="Kaca" {{ old('waste_type') == 'Kaca' ? 'selected' : '' }}>Kaca</option>
                        <option value="Elektronik" {{ old('waste_type') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                        <option value="Lainnya" {{ old('waste_type') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                
                <div>
                    <label for="estimated_weight" class="block text-sm font-medium text-gray-700 mb-1">Perkiraan Berat</label>
                    <select id="estimated_weight" name="estimated_weight" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                        <option value="" disabled {{ old('estimated_weight') ? '' : 'selected' }}>Pilih perkiraan berat</option>
                        <option value="< 1 kg" {{ old('estimated_weight') == '< 1 kg' ? 'selected' : '' }}>< 1 kg</option>
                        <option value="1-5 kg" {{ old('estimated_weight') == '1-5 kg' ? 'selected' : '' }}>1-5 kg</option>
                        <option value="5-10 kg" {{ old('estimated_weight') == '5-10 kg' ? 'selected' : '' }}>5-10 kg</option>
                        <option value="10-20 kg" {{ old('estimated_weight') == '10-20 kg' ? 'selected' : '' }}>10-20 kg</option>
                        <option value="> 20 kg" {{ old('estimated_weight') == '> 20 kg' ? 'selected' : '' }}>> 20 kg</option>
                    </select>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="pickup_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Penjemputan</label>
                    <input type="text" id="pickup_date" name="pickup_date" value="{{ old('pickup_date') }}" placeholder="Pilih tanggal" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                </div>
                
                <div>
    <label for="pickup_time" class="block text-sm font-medium text-gray-700 mb-1">Waktu Penjemputan</label>
    <input type="time" id="pickup_time" name="pickup_time" value="{{ old('pickup_time') }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
</div>

            </div>
            
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan (Opsional)</label>
                <textarea id="notes" name="notes" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('notes') }}</textarea>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-primary-500 text-white font-medium px-6 py-2 rounded-lg hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-colors">
                    Kirim Permintaan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script>
    // Initialize date picker
    flatpickr("#pickup_date", {
        minDate: "today",
        dateFormat: "Y-m-d",
    });
    
    // Initialize map
    const defaultCoords = document.getElementById('coordinates').value.split(',');
    const map = L.map('map').setView([parseFloat(defaultCoords[0]), parseFloat(defaultCoords[1])], 13);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    // Add marker
    let marker = L.marker([parseFloat(defaultCoords[0]), parseFloat(defaultCoords[1])]).addTo(map);
    
    // Update marker on map click
    map.on('click', function(e) {
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(e.latlng).addTo(map);
        document.getElementById('coordinates').value = e.latlng.lat + ',' + e.latlng.lng;
    });
    
    // Add location button
    const locationButton = L.control({position: 'bottomright'});
    locationButton.onAdd = function(map) {
        const div = L.DomUtil.create('div', 'location-button');
        div.innerHTML = '<button type="button" class="bg-white text-gray-700 px-3 py-1 rounded-lg text-sm shadow-sm"><i class="fas fa-crosshairs mr-1"></i> Lokasi Saya</button>';
        div.onclick = function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    
                    if (marker) {
                        map.removeLayer(marker);
                    }
                    marker = L.marker([lat, lng]).addTo(map);
                    map.setView([lat, lng], 15);
                    document.getElementById('coordinates').value = lat + ',' + lng;
                });
            }
        };
        return div;
    };
    locationButton.addTo(map);
</script>
@endsection
