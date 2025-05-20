<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Cloudinary;

class ReportController extends Controller
{
    /**
     * User mengirim laporan dengan foto.
     */
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
                'status'      => Report::STATUS_MENUNGGU, // ✅ gunakan konstanta
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


    /**
     * Admin lihat semua laporan, user hanya lihat laporan miliknya.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $reports = Report::with('user')->latest()->get();
        } else {
            $reports = Report::with('user')->where('user_id', Auth::id())->latest()->get();
        }

        return response()->json(['reports' => $reports]);
    }

    /**
     * Admin atau user melihat detail laporan.
     */
    public function show($id)
    {
        $report = Report::with('user')->findOrFail($id);

        if (Auth::user()->role !== 'admin' && $report->user_id !== Auth::id()) {
            return response()->json(['message' => 'Tidak diizinkan melihat laporan ini.'], 403);
        }

        return response()->json(['report' => $report]);
    }

    /**
     * Admin mencari laporan berdasarkan keyword (judul/lokasi).
     */
    public function search(Request $request)
    {
        $keyword = $request->query('keyword');

        $reports = Report::where('title', 'like', "%$keyword%")
            ->orWhere('location', 'like', "%$keyword%")
            ->with('user')
            ->latest()
            ->get();

        return response()->json(['reports' => $reports]);
    }

    /**
     * Admin atau user menghapus laporan.
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);

        if (Auth::user()->role !== 'admin' && $report->user_id !== Auth::id()) {
            return response()->json(['message' => 'Tidak diizinkan menghapus laporan ini.'], 403);
        }

        $report->delete();

        return response()->json(['message' => 'Laporan berhasil dihapus.']);
    }

    /**
     * Admin mengubah status laporan.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,ditindaklanjuti,selesai',
        ]);

        $report = Report::findOrFail($id);
        $report->status = $request->status;
        $report->save();

        return response()->json([
            'message' => 'Status laporan berhasil diperbarui.',
            'report'  => $report->load('user'),
        ]);
    }
}
