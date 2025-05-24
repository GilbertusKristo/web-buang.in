@extends('layouts.user')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')

<!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

<div class="bg-primary-500 text-white rounded-xl p-6 mb-6">
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold mb-2">Selamat datang, {{ Auth::user()->name ?? 'User' }}!</h2>
            <p class="opacity-90">Kelola sampah dengan bijak bersama Buang.in</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('user.pickup.form') }}" class="inline-block bg-white text-primary-600 font-medium px-4 py-2 rounded-lg hover:bg-primary-50 transition-colors">
                Ajukan Penjemputan
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm flex items-center">
        <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 mr-4">
            <i class="fas fa-recycle text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Total Sampah</p>
            <p class="text-2xl font-bold text-gray-800">{{ number_format($totalWeight, 1) }} <span class="text-sm font-normal">kg</span></p>
        </div>
    </div>
    
    <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm flex items-center">
        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-4">
            <i class="fas fa-truck text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Permintaan</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalPickupRequests }}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm flex items-center">
        <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 mr-4">
            <i class="fas fa-flag text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Laporan</p>
            <p class="text-2xl font-bold text-gray-800">{{ $totalReports }}</p>
        </div>
    </div>
    
    <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm flex items-center">
        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 mr-4">
            <i class="fas fa-coins text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Poin</p>
            <p class="text-2xl font-bold text-gray-800">{{ (int)$points }}</p>
        </div>
    </div>
</div>

<h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h3>

<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden mb-8">
    @if($recentActivities->count() > 0)
        @foreach($recentActivities as $activity)
            <div class="p-4 flex items-start border-b border-gray-200">
                <div class="w-10 h-10 rounded-full bg-gray-200 flex-shrink-0 mr-4 overflow-hidden">
                    @if($activity['type'] == 'pickup')
                        <div class="w-full h-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-truck text-blue-600"></i>
                        </div>
                    @else
                        <div class="w-full h-full bg-yellow-100 flex items-center justify-center">
                            <i class="fas fa-flag text-yellow-600"></i>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <p class="font-medium text-gray-800">{{ $activity['title'] }}</p>
                    <p class="text-sm text-gray-500 mb-2">{{ $activity['date']->format('d M Y') }} • {{ $activity['date']->format('H:i') }}</p>
                    <div class="inline-block px-2 py-1 
                        @if($activity['status'] == 'Menunggu Konfirmasi')
                            bg-yellow-100 text-yellow-800
                        @elseif($activity['status'] == 'Selesai')
                            bg-green-100 text-green-800
                        @elseif($activity['status'] == 'Ditolak')
                            bg-red-100 text-red-800
                        @elseif($activity['status'] == 'Diproses')
                            bg-blue-100 text-blue-800
                        @else
                            bg-gray-100 text-gray-800
                        @endif
                        text-xs rounded-full">
                        {{ $activity['status'] }}
                    </div>
                </div>
                <a href="{{ $activity['type'] == 'pickup' ? route('user.pickup.requests') : route('user.reports') }}" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        @endforeach
    @else
        <div class="p-4 text-center text-gray-500">
            Belum ada aktivitas terbaru
        </div>
    @endif
</div>


@endsection
