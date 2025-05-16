@extends('layouts.auth')

@section('title', 'Daftar')

@section('main')
<div class="container">
    <div class="auth-card">
        <div class="logo">
            <img src="{{ asset('img/buangin.png') }}" alt="Buang.in">
        </div>

        <h1>Buat Akun Baru</h1>
        <p class="subtitle">Bergabunglah Dengan Kami untuk lingkungan yang lebih baik</p>

        <form method="POST" action="{{ route('web.auth.register') }}" id="registerForm">
            @csrf

            <div class="step" id="step1">
                <div class="step-indicator">
                    <div class="step-circle active"><span>1</span></div>
                    <div class="step-label">Informasi Pribadi</div>
                    <div class="step-circle"><span>2</span></div>
                    <div class="step-label">Keamanan</div>
                </div>

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <button type="button" class="btn btn-primary" onclick="nextStep()">Lanjutkan</button>

                <div class="auth-footer">
                    <p>Sudah Punya Akun? <a href="{{ route('auth.login.form') }}">Masuk</a></p>
                </div>
            </div>

            <div class="step" id="step2" style="display: none;">
                <div class="step-indicator">
                    <div class="step-circle"><span>1</span></div>
                    <div class="step-label">Informasi Pribadi</div>
                    <div class="step-circle active"><span>2</span></div>
                    <div class="step-label">Keamanan</div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-secondary" onclick="prevStep()">Kembali</button>
                    <button type="submit" class="btn btn-primary">Lanjutkan</button>
                </div>

                <div class="auth-footer">
                    <p>Sudah Punya Akun? <a href="{{ route('auth.login.form') }}">Masuk</a></p>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function nextStep() {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
    }

    function prevStep() {
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step1').style.display = 'block';
    }
</script>
@endsection
