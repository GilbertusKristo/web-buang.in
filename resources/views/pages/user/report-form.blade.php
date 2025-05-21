@extends('layouts.user')

@section('title', 'Form Laporan Sampah')

@section('header', 'Form Laporan Sampah')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="border-b border-gray-200 bg-gray-50 px-4 py-3">
        <h2 class="font-semibold text-gray-800">Form Laporan Sampah</h2>
        <p class="text-sm text-gray-500">Laporkan tumpukan sampah yang anda temukan di sekitar lingkungan anda</p>
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
        
        <form action="{{ route('user.report.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Laporan</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Contoh: Tumpukan sampah di Taman Kota" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea id="description" name="description" rows="3" placeholder="Jelaskan secara detail tentang sampah yang anda temukan" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>{{ old('description') }}</textarea>
            </div>
            
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lokasi</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="Contoh: Jl. Merdeka No. 123, Jakarta" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi di Peta</label>
                <div id="map" class="h-64 bg-gray-200 rounded-lg mb-2 relative"></div>
                <input type="hidden" id="coordinates" name="coordinates" value="{{ old('coordinates', '-6.200000,106.816666') }}">
                <p class="text-xs text-gray-500">Klik pada peta untuk menentukan lokasi atau gunakan tombol "Lokasi Saya"</p>
            </div>
            
            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Foto Sampah</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                    <div class="mb-3">
                        <i class="fas fa-camera text-4xl text-gray-400"></i>
                    </div>
                    <p class="text-sm text-gray-500 mb-2">Klik untuk mengunggah atau seret foto ke sini</p>
                    <p class="text-xs text-gray-400">Format: JPG, JPEG, PNG (Maks. 2MB)</p>
                    <input type="file" id="photo" name="photo" accept="image/jpeg,image/png" class="hidden" required>
                    <button type="button" onclick="document.getElementById('photo').click()" class="mt-3 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-200 transition-colors">
                        Pilih Foto
                    </button>
                </div>
                <div id="preview-container" class="mt-3 hidden">
                    <p class="text-sm font-medium text-gray-700 mb-1">Preview:</p>
                    <div class="relative">
                        <img id="preview-image" src="#" alt="Preview" class="w-full h-48 object-cover rounded-lg">
                        <button type="button" id="remove-image" class="absolute top-2 right-2 bg-white text-gray-700 rounded-full w-8 h-8 flex items-center justify-center shadow-md hover:bg-gray-100">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-primary-500 text-white font-medium px-6 py-2 rounded-lg hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-colors">
                    Kirim Laporan
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
    // Preview image
    const photoInput = document.getElementById('photo');
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    const removeImageBtn = document.getElementById('remove-image');
    
    photoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            
            reader.readAsDataURL(file);
        }
    });
    
    removeImageBtn.addEventListener('click', function() {
        photoInput.value = '';
        previewContainer.classList.add('hidden');
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
