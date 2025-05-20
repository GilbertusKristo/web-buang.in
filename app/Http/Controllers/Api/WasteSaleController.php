<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WasteSale;
use Illuminate\Support\Facades\Auth;
use Exception;
use Cloudinary\Cloudinary;

class WasteSaleController extends Controller
{
    /**
     * Menyimpan transaksi penjualan sampah baru.
     */
public function store(Request $request, Cloudinary $cloudinary)
{
    $validated = $request->validate([
        'waste_type'     => 'required|string',
        'weight'         => 'required|numeric|min:0.1',
        'price_per_kg'   => 'required|numeric|min:0',
        'sale_date'      => 'required|date',
        'photo'          => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'notes'          => 'nullable|string'
    ]);

    try {
        // Upload ke Cloudinary menggunakan uploadApi seperti updateProfilePicture
        $uploadedFile = $cloudinary->uploadApi()->upload(
            $request->file('photo')->getRealPath(),
            ['folder' => 'waste_sales']
        );

        $total = $validated['weight'] * $validated['price_per_kg'];

        $sale = WasteSale::create([
            'user_id'       => Auth::id(),
            'waste_type'    => $validated['waste_type'],
            'weight'        => $validated['weight'],
            'price_per_kg'  => $validated['price_per_kg'],
            'total_price'   => $total,
            'sale_date'     => $validated['sale_date'],
            'notes'         => $validated['notes'],
            'photo_path'    => $uploadedFile['secure_url'],
            'status'        => 'menunggu verifikasi'
        ]);

        return response()->json([
            'message' => 'Penjualan berhasil dicatat',
            'data' => $sale
        ], 201);
    } catch (Exception $e) {
        return response()->json([
            'message' => 'Gagal menyimpan transaksi',
            'error' => $e->getMessage()
        ], 500);
    }
}


    /**
     * Melihat semua riwayat penjualan milik user.
     */
public function index()
{
    $sales = WasteSale::with('user')
        ->where('user_id', Auth::id())
        ->latest()
        ->get()
        ->map(function ($sale) {
            return [
                'id'            => $sale->id,
                'user_id'       => $sale->user_id,
                'user_name'     => $sale->user->name, // di sini
                'waste_type'    => $sale->waste_type,
                'weight'        => $sale->weight,
                'price_per_kg'  => $sale->price_per_kg,
                'total_price'   => $sale->total_price,
                'notes'         => $sale->notes,
                'photo_path'    => $sale->photo_path,
                'status'        => $sale->status,
                'sale_date'     => $sale->sale_date,
                'created_at'    => $sale->created_at,
                'updated_at'    => $sale->updated_at,
            ];
        });

    return response()->json(['data' => $sales]);
}


    /**
     * Filter riwayat penjualan berdasarkan tanggal.
     */
    public function historyByDate(Request $request)
    {
        $validated = $request->validate([
            'from' => 'required|date',
            'to'   => 'required|date|after_or_equal:from'
        ]);

        $sales = WasteSale::where('user_id', Auth::id())
            ->whereBetween('sale_date', [$validated['from'], $validated['to']])
            ->latest()
            ->get();

        return response()->json(['data' => $sales]);
    }

    /**
     * Admin: Update status transaksi penjualan.
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu verifikasi,disetujui,ditolak'
        ]);

        try {
            $sale = WasteSale::findOrFail($id);
            $sale->status = $validated['status'];
            $sale->save();

            return response()->json(['message' => 'Status berhasil diperbarui', 'data' => $sale]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Gagal memperbarui status', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Admin: Rekap total penjualan.
     */
public function summary()
{
    $bulanNama = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ];

    $data = WasteSale::selectRaw('YEAR(sale_date) as year, MONTH(sale_date) as month, COUNT(*) as jumlah, SUM(weight) as total_weight, SUM(total_price) as total_earned, AVG(price_per_kg) as avg_price')
        ->groupByRaw('YEAR(sale_date), MONTH(sale_date)')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get()
        ->map(function ($item) use ($bulanNama) {
            return [
                'tahun' => $item->year,
                'bulan' => [
                    'angka' => $item->month,
                    'nama' => $bulanNama[$item->month],
                ],
                'jumlah_transaksi' => $item->jumlah,
                'total_berat_sampah' => [
                    'nilai' => round($item->total_weight, 2),
                    'satuan' => 'kg'
                ],
                'total_pendapatan' => [
                    'nilai' => (int) $item->total_earned,
                    'format_rupiah' => 'Rp ' . number_format($item->total_earned, 0, ',', '.')
                ],
                'rata_rata_harga_per_kg' => [
                    'nilai' => round($item->avg_price, 2),
                    'format_rupiah' => 'Rp ' . number_format($item->avg_price, 0, ',', '.')
                ]
            ];
        });

    return response()->json(['summary' => $data]);
}

}
