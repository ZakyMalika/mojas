<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalService;

class RentalServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = RentalService::query();
        
        // Filter by guest type
        if ($request->has('guest_type') && $request->guest_type != '') {
            $query->where('guest_type', $request->guest_type);
        }
        
        // Search by name
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        // Filter by active status
        if ($request->has('is_active') && $request->is_active != '') {
            $query->where('is_active', $request->is_active);
        }
        
        $rentalServices = $query->orderBy('name')->paginate(15);
        
        return view('rental-services.index', compact('rentalServices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rental-services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'guest_type' => 'required|in:singapore,malaysia,local',
            'currency' => 'required|string|size:3',
            'price_per_12_hours' => 'required|numeric|min:0',
            'includes_driver' => 'boolean',
            'max_hours' => 'required|integer|min:1',
            'overtime_rate_per_hour' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'included_services' => 'nullable|array',
            'is_active' => 'boolean'
        ]);
        
        $rentalService = RentalService::create($request->all());
        
        return redirect()->route('rental-services.show', $rentalService->id)
                         ->with('success', 'Layanan rental berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rentalService = RentalService::find($id);
        
        if (!$rentalService) {
            return redirect()->route('rental-services.index')
                           ->withErrors(['error' => 'Layanan rental tidak ditemukan']);
        }
        
        // Get bookings for this rental service
        $recentBookings = $rentalService->bookings()
                                       ->with('orangTua')
                                       ->orderBy('created_at', 'desc')
                                       ->limit(10)
                                       ->get();
        
        return view('rental-services.show', compact('rentalService', 'recentBookings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rentalService = RentalService::find($id);
        
        if (!$rentalService) {
            return redirect()->route('rental-services.index')
                           ->withErrors(['error' => 'Layanan rental tidak ditemukan']);
        }
        
        return view('rental-services.edit', compact('rentalService'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rentalService = RentalService::find($id);
        
        if (!$rentalService) {
            return redirect()->route('rental-services.index')
                           ->withErrors(['error' => 'Layanan rental tidak ditemukan']);
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'guest_type' => 'required|in:singapore,malaysia,local',
            'currency' => 'required|string|size:3',
            'price_per_12_hours' => 'required|numeric|min:0',
            'includes_driver' => 'boolean',
            'max_hours' => 'required|integer|min:1',
            'overtime_rate_per_hour' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'included_services' => 'nullable|array',
            'is_active' => 'boolean'
        ]);
        
        $rentalService->update($request->all());
        
        return redirect()->route('rental-services.show', $rentalService->id)
                         ->with('success', 'Layanan rental berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rentalService = RentalService::find($id);
        
        if (!$rentalService) {
            return redirect()->route('rental-services.index')
                           ->withErrors(['error' => 'Layanan rental tidak ditemukan']);
        }
        
        // Check if rental service has bookings
        if ($rentalService->bookings()->count() > 0) {
            return redirect()->route('rental-services.index')
                           ->withErrors(['error' => 'Tidak dapat menghapus layanan rental yang masih memiliki booking']);
        }
        
        $rentalService->delete();
        
        return redirect()->route('rental-services.index')
                         ->with('success', 'Layanan rental berhasil dihapus!');
    }
}
