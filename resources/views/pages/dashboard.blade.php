<<<<<<< HEAD
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
    <h1>Selamat Datang di Dashboard</h1>
    <p>Ini adalah halaman setelah Anda berhasil login.</p>
    <a href="{{ url('/auth/logout') }}" class="btn btn-danger mt-3">Logout</a>
</div>
@endsection
=======
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Buang.in</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="bg-green-50 flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-green-700 mb-4">🎉 Berhasil Masuk, Ges!</h1>
        <p class="text-gray-600">Selamat datang di dashboard dummy Buang.in</p>
    </div>
</body>
</html>
>>>>>>> 515a80e (update landing page)
