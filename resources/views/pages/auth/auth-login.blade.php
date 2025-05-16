<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Buang.in</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container">
        <div class="auth-card">
            <div class="logo">
                <img src="{{ asset('img/buangin.png') }}" alt="Buang.in">
            </div>

            <h1>Masuk Ke Akun Anda</h1>
            <p class="subtitle">Masukkan Username dan Password anda</p>

            <form method="POST" action="{{ route('web.auth.login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <div class="forgot-password">
                        {{-- <a href="{{ route("#") }}">Lupa Password?</a> --}}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Masuk</button>
                <div class="auth-footer">
                    <p>Belum punya akun? <a href="{{ route('auth.register.form') }}">Daftar sekarang</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
