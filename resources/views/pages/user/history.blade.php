@extends('layouts.user')

@section('title', 'Riwayat')

@section('header', 'Riwayat')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-6">
    <div class="border-b border-gray-200 px-4 py-3 flex justify-between items-center">
        <h2 class="font-semibold text-gray-800">Riwayat Aktivitas</h2>
        
        <div class="flex items-center">
            <select id="filter-type" class="px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 mr-2">
                <option value="all">Semua</option>
                <option value="pickup">Permintaan Jemput</option>
                <option value="report">Laporan</option>
            </select>
        </div>
    </div>
    
    <div class="p-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jenis
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Judul/Deskripsi
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="history-table-body">
                    @if(count($pickupRequests) > 0 || count($reports) > 0)
                        @foreach($pickupRequests as $request)
                            <tr class="history-row pickup-row hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    #PU{{ str_pad($request->id, 3, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Jemput
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Permintaan jemput {{ $request->waste_type }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($request->created_at)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($request->status == 'Menunggu Konfirmasi')
                                            bg-yellow-100 text-yellow-800
                                        @elseif($request->status == 'Selesai')
                                            bg-green-100 text-green-800
                                        @elseif($request->status == 'Ditolak')
                                            bg-red-100 text-red-800
                                        @elseif($request->status == 'Diproses')
                                            bg-blue-100 text-blue-800
                                        @else
                                            bg-gray-100 text-gray-800
                                        @endif
                                    ">
                                        {{ $request->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-primary-600 hover:text-primary-900 mr-3" onclick="showPickupDetails({{ $request->id }})">Detail</a>
                                    @if($request->status == 'Menunggu Konfirmasi')
                                        <a href="#" class="text-red-600 hover:text-red-900" onclick="cancelPickup({{ $request->id }})">Batalkan</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        
                        @foreach($reports as $report)
                            <tr class="history-row report-row hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    #RP{{ str_pad($report->id, 3, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Laporan
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $report->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($report->created_at)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Dilaporkan
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="#" class="text-primary-600 hover:text-primary-900" onclick="showReportDetails({{ $report->id }})">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Belum ada riwayat aktivitas
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pickup Detail Modal -->
<div id="pickup-detail-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl max-w-lg w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
            <h3 class="font-semibold text-lg text-gray-800">Detail Permintaan Jemput</h3>
            <button onclick="closePickupModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6" id="pickup-detail-content">
            <!-- Content will be loaded dynamically -->
        </div>
    </div>
</div>

<!-- Report Detail Modal -->
<div id="report-detail-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-xl max-w-lg w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
            <h3 class="font-semibold text-lg text-gray-800">Detail Laporan</h3>
            <button onclick="closeReportModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6" id="report-detail-content">
            <!-- Content will be loaded dynamically -->
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Filter functionality
    document.getElementById('filter-type').addEventListener('change', function() {
        const filterValue = this.value;
        const rows = document.querySelectorAll('.history-row');
        
        rows.forEach(row => {
            if (filterValue === 'all') {
                row.style.display = '';
            } else if (filterValue === 'pickup' && row.classList.contains('pickup-row')) {
                row.style.display = '';
            } else if (filterValue === 'report' && row.classList.contains('report-row')) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    
    // Pickup detail modal
    function showPickupDetails(id) {
        // In a real application, you would fetch this data from the server
        // For now, we'll use dummy data
        const pickupRequests = @json($pickupRequests);
        const pickup = pickupRequests.find(p => p.id === id);
        
        if (pickup) {
            let statusClass = '';
            if (pickup.status === 'Menunggu Konfirmasi') statusClass = 'bg-yellow-100 text-yellow-800';
            else if (pickup.status === 'Selesai') statusClass = 'bg-green-100 text-green-800';
            else if (pickup.status === 'Ditolak') statusClass = 'bg-red-100 text-red-800';
            else if (pickup.status === 'Diproses') statusClass = 'bg-blue-100 text-blue-800';
            else statusClass = 'bg-gray-100 text-gray-800';
            
            const content = `
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <h4 class="font-medium text-gray-800">ID Permintaan</h4>
                        <p>#PU${String(pickup.id).padStart(3, '0')}</p>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <h4 class="font-medium text-gray-800">Status</h4>
                        <span class="px-2 py-1 rounded-full text-xs font-medium ${statusClass}">${pickup.status}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <h4 class="font-medium text-gray-800">Tanggal Permintaan</h4>
                        <p>${new Date(pickup.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</p>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <h4 class="font-medium text-gray-800">Jenis Sampah</h4>
                        <p>${pickup.waste_type}</p>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <h4 class="font-medium text-gray-800">Perkiraan Berat</h4>
                        <p>${pickup.estimated_weight}</p>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <h4 class="font-medium text-gray-800">Tanggal Jemput</h4>
                        <p>${new Date(pickup.pickup_date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</p>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <h4 class="font-medium text-gray-800">Waktu Jemput</h4>
                        <p>${pickup.pickup_time}</p>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4">
                        <h4 class="font-medium text-gray-800 mb-2">Alamat Jemput</h4>
                        <p class="text-gray-600">${pickup.address}</p>
                    </div>
                    
                    ${pickup.notes ? `
                    <div class="border-t border-gray-200 pt-4">
                        <h4 class="font-medium text-gray-800 mb-2">Catatan</h4>
                        <p class="text-gray-600">${pickup.notes}</p>
                    </div>
                    ` : ''}
                    
                    <div class="border-t border-gray-200 pt-4">
                        <h4 class="font-medium text-gray-800 mb-2">Lokasi di Peta</h4>
                        <div id="detail-map" class="h-48 bg-gray-200 rounded-lg"></div>
                    </div>
                </div>
            `;
            
            document.getElementById('pickup-detail-content').innerHTML = content;
            document.getElementById('pickup-detail-modal').classList.remove('hidden');
            
            // Initialize map
            setTimeout(() => {
                const coords = pickup.coordinates.split(',');
                const detailMap = L.map('detail-map').setView([parseFloat(coords[0]), parseFloat(coords[1])], 15);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(detailMap);
                
                L.marker([parseFloat(coords[0]), parseFloat(coords[1])]).addTo(detailMap);
            }, 100);
        }
    }
    
    function closePickupModal() {
        document.getElementById('pickup-detail-modal').classList.add('hidden');
    }
    
    // Report detail modal
    function showReportDetails(id) {
        // In a real application, you would fetch this data from the server
        // For now, we'll use dummy data
        const reports = @json($reports);
        const report = reports.find(r => r.id === id);
        
        if (report) {
            const content = `
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <h4 class="font-medium text-gray-800">ID Laporan</h4>
                        <p>#RP${String(report.id).padStart(3, '0')}</p>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <h4 class="font-medium text-gray-800">Tanggal Laporan</h4>
                        <p>${new Date(report.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</p>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4">
                        <h4 class="font-medium text-gray-800 mb-2">Judul</h4>
                        <p class="text-gray-600">${report.title}</p>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4">
                        <h4 class="font-medium text-gray-800 mb-2">Deskripsi</h4>
                        <p class="text-gray-600">${report.description}</p>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4">
                        <h4 class="font-medium text-gray-800 mb-2">Alamat Lokasi</h4>
                        <p class="text-gray-600">${report.location}</p>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4">
                        <h4 class="font-medium text-gray-800 mb-2">Foto</h4>
                        <img src="${report.photo_path}" alt="Foto Laporan" class="w-full h-48 object-cover rounded-lg">
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4">
                        <h4 class="font-medium text-gray-800 mb-2">Lokasi di Peta</h4>
                        <div id="report-detail-map" class="h-48 bg-gray-200 rounded-lg"></div>
                    </div>
                </div>
            `;
            
            document.getElementById('report-detail-content').innerHTML = content;
            document.getElementById('report-detail-modal').classList.remove('hidden');
            
            // Initialize map
            setTimeout(() => {
                const coords = report.coordinates.split(',');
                const detailMap = L.map('report-detail-map').setView([parseFloat(coords[0]), parseFloat(coords[1])], 15);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(detailMap);
                
                L.marker([parseFloat(coords[0]), parseFloat(coords[1])]).addTo(detailMap);
            }, 100);
        }
    }
    
    function closeReportModal() {
        document.getElementById('report-detail-modal').classList.add('hidden');
    }
    
    // Cancel pickup request
    function cancelPickup(id) {
        if (confirm('Apakah Anda yakin ingin membatalkan permintaan jemput ini?')) {
            // In a real application, you would send an AJAX request to the server
            alert('Permintaan jemput berhasil dibatalkan');
            location.reload();
        }
    }
</script>
@endsection
