<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PickupRequest;
use App\Models\Report;
use App\Models\WasteSale;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function getDashboardData()
    {
        $pickupRequests = PickupRequest::where('user_id', Auth::id())->get();
        $reports = Report::where('user_id', Auth::id())->get();
        $wasteSales = WasteSale::where('user_id', Auth::id())->get();
        
        $totalPickupRequests = $pickupRequests->count();
        $totalReports = $reports->count();
        $totalWasteSales = $wasteSales->count();
        
        // Calculate total waste weight
        $totalWeight = 0;
        foreach ($pickupRequests as $request) {
            // Extract numeric value from estimated_weight
            $weight = $request->estimated_weight;
            if (strpos($weight, '<') !== false) {
                $weight = 0.5; // Assume < 1 kg is 0.5 kg
            } elseif (strpos($weight, '>') !== false) {
                $weight = 25; // Assume > 20 kg is 25 kg
            } else {
                // Extract range like "1-5 kg"
                $range = explode('-', $weight);
                if (count($range) > 1) {
                    $min = (float) $range[0];
                    $max = (float) $range[1];
                    $weight = ($min + $max) / 2; // Average of range
                } else {
                    $weight = (float) $weight;
                }
            }
            
            $totalWeight += $weight;
        }
        
        // Add waste sales weight
        foreach ($wasteSales as $sale) {
            $totalWeight += (float) $sale->estimated_weight;
        }
        
        // Calculate points (example: 10 points per kg + 5 points per report + 15 points per waste sale)
        $points = ($totalWeight * 10) + ($totalReports * 5) + ($totalWasteSales * 15);
        
        // Get recent activities (combined pickup requests, reports, and waste sales)
        $activities = collect();
        
        foreach ($pickupRequests as $request) {
            $activities->push([
                'type' => 'pickup',
                'title' => 'Permintaan jemput ' . $request->waste_type,
                'date' => $request->created_at,
                'status' => $request->status,
                'id' => $request->id
            ]);
        }
        
        foreach ($reports as $report) {
            $activities->push([
                'type' => 'report',
                'title' => $report->title,
                'date' => $report->created_at,
                'status' => 'Dilaporkan',
                'id' => $report->id
            ]);
        }
        
        foreach ($wasteSales as $sale) {
            $activities->push([
                'type' => 'waste_sale',
                'title' => 'Penjualan ' . $sale->waste_type,
                'date' => $sale->created_at,
                'status' => $sale->status,
                'id' => $sale->id
            ]);
        }
        
        // Sort by date (newest first) and take only 5
        $recentActivities = $activities->sortByDesc('date')->take(5);
        
        return view('pages.user.dashboard', compact('totalPickupRequests', 'totalReports', 'totalWasteSales', 'totalWeight', 'points', 'recentActivities'));
    }
    
    public function storePickupRequest(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'coordinates' => 'required|string',
            'waste_type' => 'required|string|max:50',
           'estimated_weight' => 'required|string|max:20',
            'pickup_date' => 'required|date|after_or_equal:today',
            'pickup_time' => 'required|string',
            'notes' => 'nullable|string',
        ]);
        
        // Create pickup request
        $pickupRequest = new PickupRequest();
        $pickupRequest->user_id = Auth::id();
        $pickupRequest->name = $validated['name'];
        $pickupRequest->phone = $validated['phone'];
        $pickupRequest->address = $validated['address'];
        $pickupRequest->coordinates = $validated['coordinates'];
        $pickupRequest->waste_type = $validated['waste_type'];
        $pickupRequest->estimated_weight = $validated['estimated_weight'];
        $pickupRequest->pickup_date = $validated['pickup_date'];
        $pickupRequest->pickup_time = $validated['pickup_time'];
        $pickupRequest->notes = $validated['notes'] ?? null;
        $pickupRequest->status = 'pending';
        $pickupRequest->save();
        
      return redirect()->route('user.dashboard')->with('success', 'Laporan berhasil dibuat.');

    }
    
    public function getPickupRequests()
    {
        $pickupRequests = PickupRequest::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('pages.user.pickup-requests', compact('pickupRequests'));
    }
    
    public function storeReport(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'coordinates' => 'required|string',
            'photo' => 'required|image|max:2048',
        ]);
        
        // Handle file upload
        $photoPath = $request->file('photo')->store('reports', 'public');
        
        // Create report
        $report = new Report();
        $report->user_id = Auth::id();
        $report->title = $validated['title'];
        $report->description = $validated['description'];
        $report->location = $validated['location'];
        $report->coordinates = $validated['coordinates'];
        $report->photo = $photoPath;
        $report->status = 'pending';
        $report->save();
        
        return response()->json(['success' => true, 'message' => 'Laporan berhasil dibuat']);
    }
    
    public function getReports()
    {
        $reports = Report::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('pages.user.reports', compact('reports'));
    }
    
    public function getHistory()
    {
        $pickupRequests = PickupRequest::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        $reports = Report::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        $wasteSales = WasteSale::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('pages.user.history', compact('pickupRequests', 'reports', 'wasteSales'));
    }
    
    public function sellWasteForm()
    {
        $wasteSales = WasteSale::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('pages.user.sell-waste', compact('wasteSales'));
    }
    
    public function storeWasteSale(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'waste_type' => 'required|string|max:50',
            'waste_condition' => 'required|string|max:50',
            'estimated_weight' => 'required|numeric|min:0.1',
            'description' => 'nullable|string',
            'waste_photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'pickup_address' => 'required|string',
            'coordinates' => 'required|string',
            'pickup_date' => 'required|date|after_or_equal:today',
            'pickup_time' => 'required|string',
            'notes' => 'nullable|string',
            'terms' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Format pickup_time to match the database time format
            $pickupTime = date('H:i:s', strtotime($request->pickup_time));
            
            // Handle file uploads
            $photoPaths = [];
            if ($request->hasFile('waste_photos')) {
                foreach ($request->file('waste_photos') as $photo) {
                    $filename = time() . '_' . rand(1000, 9999) . '.' . $photo->getClientOriginalExtension();
                    $path = $photo->storeAs('public/waste-sales', $filename);
                    $photoPaths[] = Storage::url($path);
                }
            }
            
            // Calculate estimated price
            $basePrice = $this->getBasePrice($request->waste_type);
            $conditionMultiplier = $this->getConditionMultiplier($request->waste_condition);
            $estimatedPrice = $basePrice * $request->estimated_weight * $conditionMultiplier;
            
            // Create waste sale
            $wasteSale = WasteSale::create([
                'user_id' => Auth::id(),
                'waste_type' => $request->waste_type,
                'waste_condition' => $request->waste_condition,
                'estimated_weight' => $request->estimated_weight,
                'description' => $request->description,
                'photos' => json_encode($photoPaths),
                'pickup_address' => $request->pickup_address,
                'coordinates' => $request->coordinates,
                'pickup_date' => $request->pickup_date,
                'pickup_time' => $pickupTime,
                'notes' => $request->notes,
                'estimated_price' => $estimatedPrice,
                'status' => 'Menunggu Konfirmasi',
            ]);

            return redirect()->route('user.waste.sell.form')->with('success', 'Permintaan penjualan sampah berhasil dikirim.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim permintaan penjualan sampah: ' . $e->getMessage())->withInput();
        }
    }
    
    private function getBasePrice($wasteType)
    {
        $prices = [
            'plastik' => 5000,
            'kertas' => 3000,
            'logam' => 10000,
            'kaca' => 1500,
            'elektronik' => 15000,
            'kardus' => 2500,
            'organik' => 1000,
        ];
        
        return $prices[$wasteType] ?? 2000;
    }
    
    private function getConditionMultiplier($condition)
    {
        $multipliers = [
            'sangat_baik' => 1.2,
            'baik' => 1.0,
            'cukup' => 0.8,
            'kurang' => 0.6,
        ];
        
        return $multipliers[$condition] ?? 1.0;
    }
    
}
