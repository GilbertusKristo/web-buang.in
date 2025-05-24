@extends('layouts.user')

@section('title', 'Jual Sampah')
@section('header', 'Jual Sampah')

@section('styles')
<style>
    .waste-type-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .waste-type-card.selected {
        border-color: #16B364;
        background-color: #EDFCF4;
    }
    
    .waste-type-card:hover:not(.selected) {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .image-preview {
        position: relative;
        width: 100px;
        height: 100px;
        margin-right: 10px;
        margin-bottom: 10px;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .image-preview .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Jual Sampah Anda</h2>
        <p class="text-gray-600 mb-6">Jual sampah Anda dengan mudah dan dapatkan harga terbaik. Isi formulir di bawah ini untuk memulai proses penjualan sampah.</p>
        
        <form id="sellWasteForm" action="{{ route('user.waste.sell.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <!-- Step 1: Pilih Jenis Sampah -->
            <div class="step" id="step1">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Langkah 1: Pilih Jenis Sampah</h3>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <div class="waste-type-card border border-gray-200 rounded-xl p-4 text-center" data-value="plastik">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-800">Plastik</h4>
                        <p class="text-xs text-gray-500 mt-1">Botol, kantong, wadah</p>
                    </div>
                    
                    <div class="waste-type-card border border-gray-200 rounded-xl p-4 text-center" data-value="kertas">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-800">Kertas</h4>
                        <p class="text-xs text-gray-500 mt-1">Koran, majalah, buku</p>
                    </div>
                    
                    <div class="waste-type-card border border-gray-200 rounded-xl p-4 text-center" data-value="logam">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-800">Logam</h4>
                        <p class="text-xs text-gray-500 mt-1">Kaleng, besi, aluminium</p>
                    </div>
                    
                    <div class="waste-type-card border border-gray-200 rounded-xl p-4 text-center" data-value="kaca">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-800">Kaca</h4>
                        <p class="text-xs text-gray-500 mt-1">Botol, gelas, wadah</p>
                    </div>
                    
                    <div class="waste-type-card border border-gray-200 rounded-xl p-4 text-center" data-value="elektronik">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-800">Elektronik</h4>
                        <p class="text-xs text-gray-500 mt-1">Ponsel, komputer, kabel</p>
                    </div>
                    
                    <div class="waste-type-card border border-gray-200 rounded-xl p-4 text-center" data-value="kardus">
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-800">Kardus</h4>
                        <p class="text-xs text-gray-500 mt-1">Kotak, kemasan, karton</p>
                    </div>
                    
                    <div class="waste-type-card border border-gray-200 rounded-xl p-4 text-center" data-value="organik">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-800">Organik</h4>
                        <p class="text-xs text-gray-500 mt-1">Sisa makanan, daun</p>
                    </div>
                    
                    <div class="waste-type-card border border-gray-200 rounded-xl p-4 text-center" data-value="lainnya">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h4 class="font-medium text-gray-800">Lainnya</h4>
                        <p class="text-xs text-gray-500 mt-1">Jenis sampah lainnya</p>
                    </div>
                </div>
                
                <input type="hidden" id="waste_type" name="waste_type" required>
                
                <div class="flex justify-end mt-6">
                    <button type="button" class="next-step bg-primary-500 text-white px-6 py-3 rounded-xl font-medium hover:bg-primary-600 transition-colors">
                        Lanjutkan
                    </button>
                </div>
            </div>
            
            <!-- Step 2: Detail Sampah -->
            <div class="step hidden" id="step2">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Langkah 2: Detail Sampah</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="waste_condition" class="block text-sm font-medium text-gray-700 mb-1">Kondisi Sampah</label>
                        <select id="waste_condition" name="waste_condition" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200">
                            <option value="">Pilih Kondisi</option>
                            <option value="sangat_baik">Sangat Baik (Bersih & Terpisah)</option>
                            <option value="baik">Baik (Bersih)</option>
                            <option value="cukup">Cukup (Sedikit Kotor)</option>
                            <option value="kurang">Kurang (Kotor & Tercampur)</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="estimated_weight" class="block text-sm font-medium text-gray-700 mb-1">Perkiraan Berat (kg)</label>
                        <input type="number" id="estimated_weight" name="estimated_weight" min="0.1" step="0.1" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200" />
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Sampah</label>
                    <textarea id="description" name="description" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200" placeholder="Jelaskan detail sampah yang akan dijual, seperti jenis, merek, atau informasi lainnya"></textarea>
                </div>
                
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Sampah</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="waste_photos" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-500 hover:text-primary-600 focus-within:outline-none">
                                    <span>Upload foto</span>
                                    <input id="waste_photos" name="waste_photos[]" type="file" accept="image/*" multiple class="sr-only" />
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 5MB</p>
                        </div>
                    </div>
                    <div id="image-previews" class="flex flex-wrap mt-3"></div>
                </div>
                
                <div class="flex justify-between mt-6">
                    <button type="button" class="prev-step bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-medium hover:bg-gray-300 transition-colors">
                        Kembali
                    </button>
                    <button type="button" class="next-step bg-primary-500 text-white px-6 py-3 rounded-xl font-medium hover:bg-primary-600 transition-colors">
                        Lanjutkan
                    </button>
                </div>
            </div>
            
            <!-- Step 3: Informasi Penjemputan -->
            <div class="step hidden" id="step3">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Langkah 3: Informasi Penjemputan</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="pickup_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Penjemputan</label>
                        <textarea id="pickup_address" name="pickup_address" rows="3" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200"></textarea>
                    </div>
                    
                    <div>
                        <label for="coordinates" class="block text-sm font-medium text-gray-700 mb-1">Koordinat Lokasi</label>
                        <div class="flex items-center">
                            <input type="text" id="coordinates" name="coordinates" readonly required class="w-full px-4 py-3 rounded-l-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200" />
                            <button type="button" id="getLocation" class="bg-primary-500 text-white px-4 py-3 rounded-r-xl hover:bg-primary-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Klik tombol untuk mendapatkan lokasi Anda saat ini.</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="pickup_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Penjemputan</label>
                        <input type="date" id="pickup_date" name="pickup_date" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200" />
                    </div>
                    
                    <div>
                        <label for="pickup_time" class="block text-sm font-medium text-gray-700 mb-1">Waktu Penjemputan</label>
                        <select id="pickup_time" name="pickup_time" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200">
                            <option value="">Pilih Waktu</option>
                            <option value="08:00 - 10:00">08:00 - 10:00</option>
                            <option value="10:00 - 12:00">10:00 - 12:00</option>
                            <option value="13:00 - 15:00">13:00 - 15:00</option>
                            <option value="15:00 - 17:00">15:00 - 17:00</option>
                        </select>
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
                    <textarea id="notes" name="notes" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200" placeholder="Tambahkan catatan khusus untuk penjemputan (opsional)"></textarea>
                </div>
                
                <div class="flex justify-between mt-6">
                    <button type="button" class="prev-step bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-medium hover:bg-gray-300 transition-colors">
                        Kembali
                    </button>
                    <button type="button" class="next-step bg-primary-500 text-white px-6 py-3 rounded-xl font-medium hover:bg-primary-600 transition-colors">
                        Lanjutkan
                    </button>
                </div>
            </div>
            
            <!-- Step 4: Konfirmasi -->
            <div class="step hidden" id="step4">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Langkah 4: Konfirmasi</h3>
                
                <div class="bg-primary-50 rounded-xl p-6 mb-6">
                    <h4 class="font-medium text-gray-800 mb-4">Ringkasan Penjualan Sampah</h4>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jenis Sampah:</span>
                            <span class="font-medium text-gray-800" id="summary_waste_type">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kondisi Sampah:</span>
                            <span class="font-medium text-gray-800" id="summary_waste_condition">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Perkiraan Berat:</span>
                            <span class="font-medium text-gray-800" id="summary_estimated_weight">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Alamat Penjemputan:</span>
                            <span class="font-medium text-gray-800" id="summary_pickup_address">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal & Waktu:</span>
                            <span class="font-medium text-gray-800" id="summary_pickup_datetime">-</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-yellow-50 rounded-xl p-6 mb-6">
                    <h4 class="font-medium text-gray-800 mb-2">Perkiraan Harga</h4>
                    <p class="text-gray-600 text-sm mb-4">Harga akhir akan ditentukan setelah penimbangan oleh petugas.</p>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total Perkiraan:</span>
                        <span class="text-xl font-bold text-primary-600" id="estimated_price">Rp 0</span>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-xl p-6">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-gray-700">Saya menyetujui syarat dan ketentuan</label>
                            <p class="text-gray-500">Dengan mencentang kotak ini, saya menyetujui <a href="#" class="text-primary-600 hover:text-primary-500">syarat dan ketentuan</a> yang berlaku untuk penjualan sampah melalui platform Buang.in.</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-between mt-6">
                    <button type="button" class="prev-step bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-medium hover:bg-gray-300 transition-colors">
                        Kembali
                    </button>
                    <button type="submit" class="bg-primary-500 text-white px-6 py-3 rounded-xl font-medium hover:bg-primary-600 transition-colors">
                        Kirim Permintaan Penjualan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Riwayat Penjualan Sampah</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Sampah</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berat (kg)</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga (Rp)</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Contoh data -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-05-20</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Plastik</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3.5</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">17,500</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <button class="text-primary-500 hover:text-primary-600">Detail</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2023-05-15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Kertas</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2.0</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6,000</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Dalam Proses</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <button class="text-primary-500 hover:text-primary-600">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Step navigation
        const steps = document.querySelectorAll('.step');
        const nextButtons = document.querySelectorAll('.next-step');
        const prevButtons = document.querySelectorAll('.prev-step');
        let currentStep = 0;
        
        // Waste type selection
        const wasteTypeCards = document.querySelectorAll('.waste-type-card');
        const wasteTypeInput = document.getElementById('waste_type');
        
        wasteTypeCards.forEach(card => {
            card.addEventListener('click', function() {
                // Remove selected class from all cards
                wasteTypeCards.forEach(c => c.classList.remove('selected'));
                
                // Add selected class to clicked card
                this.classList.add('selected');
                
                // Set the value in the hidden input
                wasteTypeInput.value = this.dataset.value;
            });
        });
        
        // Next step button click
        nextButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Validate current step
                if (validateStep(currentStep)) {
                    // Hide current step
                    steps[currentStep].classList.add('hidden');
                    
                    // Show next step
                    currentStep++;
                    steps[currentStep].classList.remove('hidden');
                    
                    // If it's the last step, update summary
                    if (currentStep === 3) {
                        updateSummary();
                    }
                }
            });
        });
        
        // Previous step button click
        prevButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Hide current step
                steps[currentStep].classList.add('hidden');
                
                // Show previous step
                currentStep--;
                steps[currentStep].classList.remove('hidden');
            });
        });
        
        // Validate step
        function validateStep(step) {
            if (step === 0) {
                // Validate waste type selection
                if (!wasteTypeInput.value) {
                    alert('Silakan pilih jenis sampah terlebih dahulu.');
                    return false;
                }
            } else if (step === 1) {
                // Validate waste details
                const condition = document.getElementById('waste_condition').value;
                const weight = document.getElementById('estimated_weight').value;
                
                if (!condition) {
                    alert('Silakan pilih kondisi sampah.');
                    return false;
                }
                
                if (!weight || weight <= 0) {
                    alert('Silakan masukkan perkiraan berat sampah yang valid.');
                    return false;
                }
            } else if (step === 2) {
                // Validate pickup information
                const address = document.getElementById('pickup_address').value;
                const coordinates = document.getElementById('coordinates').value;
                const date = document.getElementById('pickup_date').value;
                const time = document.getElementById('pickup_time').value;
                
                if (!address) {
                    alert('Silakan masukkan alamat penjemputan.');
                    return false;
                }
                
                if (!coordinates) {
                    alert('Silakan tentukan koordinat lokasi penjemputan.');
                    return false;
                }
                
                if (!date) {
                    alert('Silakan pilih tanggal penjemputan.');
                    return false;
                }
                
                if (!time) {
                    alert('Silakan pilih waktu penjemputan.');
                    return false;
                }
            }
            
            return true;
        }
        
        // Update summary
        function updateSummary() {
            const wasteType = wasteTypeInput.value;
            const wasteCondition = document.getElementById('waste_condition').value;
            const estimatedWeight = document.getElementById('estimated_weight').value;
            const pickupAddress = document.getElementById('pickup_address').value;
            const pickupDate = document.getElementById('pickup_date').value;
            const pickupTime = document.getElementById('pickup_time').value;
            
            // Format waste type
            let formattedWasteType = wasteType.charAt(0).toUpperCase() + wasteType.slice(1);
            
            // Format waste condition
            let formattedWasteCondition = '';
            switch(wasteCondition) {
                case 'sangat_baik':
                    formattedWasteCondition = 'Sangat Baik (Bersih & Terpisah)';
                    break;
                case 'baik':
                    formattedWasteCondition = 'Baik (Bersih)';
                    break;
                case 'cukup':
                    formattedWasteCondition = 'Cukup (Sedikit Kotor)';
                    break;
                case 'kurang':
                    formattedWasteCondition = 'Kurang (Kotor & Tercampur)';
                    break;
                default:
                    formattedWasteCondition = wasteCondition;
            }
            
            // Update summary elements
            document.getElementById('summary_waste_type').textContent = formattedWasteType;
            document.getElementById('summary_waste_condition').textContent = formattedWasteCondition;
            document.getElementById('summary_estimated_weight').textContent = estimatedWeight + ' kg';
            document.getElementById('summary_pickup_address').textContent = pickupAddress;
            document.getElementById('summary_pickup_datetime').textContent = formatDate(pickupDate) + ', ' + pickupTime;
            
            // Calculate estimated price
            calculateEstimatedPrice(wasteType, wasteCondition, estimatedWeight);
        }
        
        // Calculate estimated price
        function calculateEstimatedPrice(wasteType, condition, weight) {
            let basePrice = 0;
            
            // Base price per kg based on waste type
            switch(wasteType) {
                case 'plastik':
                    basePrice = 5000;
                    break;
                case 'kertas':
                    basePrice = 3000;
                    break;
                case 'logam':
                    basePrice = 10000;
                    break;
                case 'kaca':
                    basePrice = 1500;
                    break;
                case 'elektronik':
                    basePrice = 15000;
                    break;
                case 'kardus':
                    basePrice = 2500;
                    break;
                case 'organik':
                    basePrice = 1000;
                    break;
                default:
                    basePrice = 2000;
            }
            
            // Condition multiplier
            let conditionMultiplier = 1;
            switch(condition) {
                case 'sangat_baik':
                    conditionMultiplier = 1.2;
                    break;
                case 'baik':
                    conditionMultiplier = 1;
                    break;
                case 'cukup':
                    conditionMultiplier = 0.8;
                    break;
                case 'kurang':
                    conditionMultiplier = 0.6;
                    break;
            }
            
            // Calculate total price
            const totalPrice = basePrice * weight * conditionMultiplier;
            
            // Format price to IDR
            const formattedPrice = new Intl.NumberFormat('id-ID').format(Math.round(totalPrice));
            
            // Update price element
            document.getElementById('estimated_price').textContent = 'Rp ' + formattedPrice;
        }
        
        // Format date
        function formatDate(dateString) {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', options);
        }
        
        // Get current location
        document.getElementById('getLocation').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    document.getElementById('coordinates').value = `${lat},${lng}`;
                }, function(error) {
                    alert('Error getting location: ' + error.message);
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        });
        
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('pickup_date').min = today;
        
        // Image preview
        document.getElementById('waste_photos').addEventListener('change', function(e) {
            const files = e.target.files;
            const previewContainer = document.getElementById('image-previews');
            
            // Clear previous previews
            previewContainer.innerHTML = '';
            
            // Add new previews
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const preview = document.createElement('div');
                        preview.className = 'image-preview';
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        
                        const removeBtn = document.createElement('div');
                        removeBtn.className = 'remove-btn';
                        removeBtn.innerHTML = '×';
                        removeBtn.addEventListener('click', function() {
                            preview.remove();
                        });
                        
                        preview.appendChild(img);
                        preview.appendChild(removeBtn);
                        previewContainer.appendChild(preview);
                    }
                    
                    reader.readAsDataURL(file);
                }
            }
        });
        
        // Form submission
        document.getElementById('sellWasteForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Check if terms are accepted
            if (!document.getElementById('terms').checked) {
                alert('Anda harus menyetujui syarat dan ketentuan untuk melanjutkan.');
                return;
            }
            
            const formData = new FormData(this);
            
            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Mengirim...';
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Permintaan penjualan sampah berhasil dikirim!');
                    window.location.reload();
                } else {
                    alert('Error: ' + (data.message || 'Terjadi kesalahan. Silakan coba lagi.'));
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
                submitButton.disabled = false;
                submitButton.textContent = originalText;
            });
        });
    });
</script>
@endsection
