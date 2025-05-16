<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController as ApiAuthController;

class AuthWebController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $apiController = new ApiAuthController();
        $response = $apiController->login($request);
        $responseData = $response->getData();

        if ($response->getStatusCode() == 200) {
            session(['token' => $responseData->token]);
            
            return redirect('/dashboard');
        }

        return back()->with('error', $responseData->message ?? 'Login gagal.');
    }
}
