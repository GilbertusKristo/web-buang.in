<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PickupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Exception;

class PickupRequestController extends Controller
{
    /**
     * Menyimpan permintaan jemput baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'address'          => 'required|string',
            'coordinates'      => 'required|string',
            'waste_type'       => 'required|string',
            'estimated_weight' => 'required|string',
            'pickup_date'      => 'required|date',
            'pickup_time'      => 'required|string',
            'notes'            => 'nullable|string',
        ]);

        try {
            $pickupRequest = PickupRequest::create([
                'user_id'          => Auth::id(),
                'name'             => $validated['name'],
                'phone'            => $validated['phone'],
                'address'          => $validated['address'],
                'coordinates'      => $validated['coordinates'],
                'waste_type'       => $validated['waste_type'],
                'estimated_weight' => $validated['estimated_weight'],
                'pickup_date'      => $validated['pickup_date'],
                'pickup_time'      => $validated['pickup_time'],
                'notes'            => $validated['notes'],
                'status'           => 'menunggu konfirmasi',
            ]);

            return response()->json([
                'message' => 'Permintaan jemput berhasil dikirim.',
                'pickup_request' => $pickupRequest->load('user'),
            ], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Gagal menyimpan permintaan jemput.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Admin mengubah status permintaan jemput.
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu konfirmasi,dalam penjemputan,selesai',
        ]);

        try {
            $pickupRequest = PickupRequest::findOrFail($id);
            $pickupRequest->status = $validated['status'];
            $pickupRequest->save();

            return response()->json(['message' => 'Status berhasil diperbarui.', 'pickup_request' => $pickupRequest->load('user')]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Gagal memperbarui status.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Admin melihat semua permintaan jemput.
     */
    public function index()
    {
        $pickupRequests = PickupRequest::with('user')->latest()->get();
        return response()->json(['pickup_requests' => $pickupRequests]);
    }

    /**
     * Admin atau User melihat detail permintaan jemput.
     */
    public function show($id)
    {
        $pickupRequest = PickupRequest::with('user')->findOrFail($id);

        // Jika user, pastikan hanya bisa melihat milik sendiri
        if (Auth::user()->role !== 'admin' && $pickupRequest->user_id !== Auth::id()) {
            return response()->json(['message' => 'Tidak diizinkan melihat permintaan ini.'], 403);
        }

        return response()->json(['pickup_request' => $pickupRequest]);
    }

    /**
     * User melihat riwayat permintaan milik sendiri.
     */
    public function history()
    {
        $pickupRequests = PickupRequest::where('user_id', Auth::id())->latest()->get();
        return response()->json(['pickup_requests' => $pickupRequests]);
    }

    /**
     * User melihat riwayat berdasarkan rentang tanggal.
     */
    public function historyByDate(Request $request)
    {
        $validated = $request->validate([
            'from' => 'required|date',
            'to'   => 'required|date|after_or_equal:from',
        ]);

        $pickupRequests = PickupRequest::where('user_id', Auth::id())
            ->whereBetween('pickup_date', [$validated['from'], $validated['to']])
            ->latest()
            ->get();

        return response()->json(['pickup_requests' => $pickupRequests]);
    }

    /**
     * Admin filter berdasarkan status.
     */
    public function filterByStatus(Request $request)
    {
        $status = $request->query('status');

        $pickupRequests = PickupRequest::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->with('user')->latest()->get();

        return response()->json(['pickup_requests' => $pickupRequests]);
    }

    /**
     * Admin cari berdasarkan nama atau alamat.
     */
    public function search(Request $request)
    {
        $keyword = $request->query('keyword');

        $pickupRequests = PickupRequest::where(function ($query) use ($keyword) {
            $query->where('name', 'like', "%$keyword%")
                  ->orWhere('address', 'like', "%$keyword%");
        })->with('user')->latest()->get();

        return response()->json(['pickup_requests' => $pickupRequests]);
    }

}
