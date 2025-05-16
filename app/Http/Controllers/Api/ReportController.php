<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Cloudinary;

class ReportController extends Controller
{
    public function store(Request $request, Cloudinary $cloudinary)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string',
            'coordinates' => 'required|string',
            'photo'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $uploadedFile = $cloudinary->uploadApi()->upload(
                $request->file('photo')->getRealPath(),
                ['folder' => 'reports']
            );

            $photoUrl = $uploadedFile['secure_url'];

            $report = Report::create([
                'user_id'     => Auth::id(),
                'title'       => $request->title,
                'description' => $request->description,
                'location'    => $request->location,
                'coordinates' => $request->coordinates,
                'photo_path'  => $photoUrl,
            ]);

            return response()->json([
                'message' => 'Laporan berhasil dikirim.',
                'report'  => $report->load('user'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengupload gambar ke Cloudinary.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
