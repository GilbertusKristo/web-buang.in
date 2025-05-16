<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PickupRequest;
use Illuminate\Support\Facades\Auth;
use Exception;

class PickupRequestController extends Controller
{
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
                'status'           => 'pending', // Optional: default status
            ]);

            return response()->json([
                'message' => 'Permintaan jemput berhasil dikirim.',
                'pickup_request' => $pickupRequest->load('user'), // Include user data
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menyimpan permintaan jemput.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
