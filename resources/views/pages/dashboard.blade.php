@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
    <h1>Selamat Datang di Dashboard</h1>
    <p>Ini adalah halaman setelah Anda berhasil login.</p>
    <a href="{{ url('/auth/logout') }}" class="btn btn-danger mt-3">Logout</a>
</div>
@endsection
