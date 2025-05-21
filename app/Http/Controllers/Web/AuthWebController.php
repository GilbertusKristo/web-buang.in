<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Api\AuthController as ApiAuthController;

class AuthWebController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input form login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Panggil login dari controller API
        $apiController = new ApiAuthController();
        $response = $apiController->login($request);
        $responseData = $response->getData();

        if ($response->getStatusCode() === 200) {
            // Simpan token ke session
            session(['token' => $responseData->token]);

            // Ambil user dari database berdasarkan email
            $user = User::where('email', $request->email)->first();

            // Login dengan session Laravel
            if ($user) {
                Auth::login($user); // Ini WAJIB untuk membuat auth()->user() aktif
            }

            // Redirect ke dashboard (akan diarahkan berdasarkan role)
            return redirect()->route('dashboard');
        }

        // Jika gagal login dari API
        return back()->with('error', $responseData->message ?? 'Login gagal.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        session()->forget('token');
        return redirect()->route('auth.login.form');
    }
}
