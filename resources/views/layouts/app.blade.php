<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Buang.in Admin</title>
    <link href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    @stack('style')
</head>
<body>
    @include('components.header')
    @include('components.sidebar')

    <div class="container-fluid py-4">
        @yield('content')
    </div>

    @include('components.footer')

    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
