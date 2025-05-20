<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'user',
            'status' => 'Aktif',
            'profile_picture' => 'user.jpg',
            'joined_date' => now(),
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'Register berhasil',
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $user
        ]);
    }
    public function updateProfilePicture(Request $request, Cloudinary $cloudinary)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $uploadedFile = $cloudinary->uploadApi()->upload(
            $request->file('profile_picture')->getRealPath(),
            ['folder' => 'profile_pictures']
        );
        
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->profile_picture = $uploadedFile['secure_url'];
        $user->save();

        return response()->json([
            'message' => 'Foto profil berhasil diperbarui.',
            'profile_picture_url' => $user->profile_picture
        ]);
    }





    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }


    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        return response()->json($user);
    }

    // Update User
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'sometimes|string|max:15',
        ]);

        $user->update($request->only('name', 'email', 'phone'));

        return response()->json([
            'message' => 'User berhasil diperbarui',
            'user' => $user
        ]);
    }


    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User berhasil dihapus']);
    }


    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Aktif,Nonaktif,Blokir',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        $user->status = $request->status;
        $user->save();

        return response()->json([
            'message' => 'Status user berhasil diubah',
            'user' => $user
        ]);
    }
}
