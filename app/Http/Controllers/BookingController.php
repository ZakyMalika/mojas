<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Orang_tua;
use App\Models\RentalService;
use App\Models\School;
use App\Services\PricingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    protected $pricingService;

    public function __construct(PricingService $pricingService)
    {
        $this->pricingService = $pricingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['orangTua', 'school', 'rentalService']);

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by service type
        if ($request->has('service_type') && $request->service_type != '') {
            $query->where('service_type', $request->service_type);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('pickup_time', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('pickup_time', '<=', $request->date_to);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orangTuas = Orang_tua::where('is_active', true)->get();
        $schools = School::where('is_active', true)->get();
        $rentalServices = RentalService::where('is_active', true)->get();

        return view('bookings.create', compact('orangTuas', 'schools', 'rentalServices'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'orang_tua_id' => 'required|exists:orang_tuas,id',
            'service_type' => 'required|in:school_transport,rental,general',
            'trip_type' => 'required|in:one_way,two_way',
            'children_ids' => 'required|array|min:1',
            'children_ids.*' => 'exists:anaks,id',
            'distance_km' => 'required|numeric|min:0',
            'pickup_time' => 'required|date',
            'pickup_address' => 'required|string|max:500',
            'destination_address' => 'required|string|max:500',
            'school_id' => 'nullable|exists:schools,id',
            'rental_service_id' => 'nullable|exists:rental_services,id',
            'return_time' => 'nullable|date',
            'return_address' => 'nullable|string|max:500',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Calculate pricing
            $pricingParams = [
                'distance_km' => $request->distance_km,
                'children_ids' => $request->children_ids,
                'trip_type' => $request->trip_type,
                'pickup_time' => $request->pickup_time,
                'return_time' => $request->return_time,
            ];

            if ($request->service_type === 'school_transport') {
                $pricingParams['school_id'] = $request->school_id;
            } elseif ($request->service_type === 'rental') {
                $pricingParams['rental_service_id'] = $request->rental_service_id;
                $pricingParams['hours'] = 12; // Default 12 hours
            }

            $pricing = $this->pricingService->getQuote($request->service_type, $pricingParams);

            // Create booking
            $booking = Booking::create([
                'orang_tua_id' => $request->orang_tua_id,
                'school_id' => $request->school_id,
                'rental_service_id' => $request->rental_service_id,
                'service_type' => $request->service_type,
                'trip_type' => $request->trip_type,
                'children_ids' => $request->children_ids,
                'distance_km' => $request->distance_km,
                'base_price' => $pricing['base_price'],
                'additional_charges' => $pricing['additional_charges'],
                'total_price' => $pricing['total_price'],
                'currency' => $pricing['currency'],
                'pickup_time' => $request->pickup_time,
                'return_time' => $request->return_time,
                'pickup_address' => $request->pickup_address,
                'destination_address' => $request->destination_address,
                'return_address' => $request->return_address,
                'pricing_breakdown' => $pricing['breakdown'],
                'notes' => $request->notes,
            ]);

            DB::commit();

            return redirect()->route('bookings.show', $booking->id)
                ->with('success', 'Booking berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Gagal membuat booking: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::with(['orangTua', 'school', 'rentalService'])->find($id);

        if (! $booking) {
            return redirect()->route('bookings.index')
                ->withErrors(['error' => 'Booking tidak ditemukan']);
        }

        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = Booking::with(['orangTua', 'school', 'rentalService'])->find($id);

        if (! $booking) {
            return redirect()->route('bookings.index')
                ->withErrors(['error' => 'Booking tidak ditemukan']);
        }

        $orangTuas = Orang_tua::where('is_active', true)->get();
        $schools = School::where('is_active', true)->get();
        $rentalServices = RentalService::where('is_active', true)->get();

        return view('bookings.edit', compact('booking', 'orangTuas', 'schools', 'rentalServices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = Booking::find($id);

        if (! $booking) {
            return redirect()->route('bookings.index')
                ->withErrors(['error' => 'Booking tidak ditemukan']);
        }

        $request->validate([
            'status' => 'sometimes|in:pending,confirmed,in_progress,completed,cancelled',
            'pickup_time' => 'sometimes|date',
            'return_time' => 'nullable|date',
            'pickup_address' => 'sometimes|string|max:500',
            'destination_address' => 'sometimes|string|max:500',
            'return_address' => 'nullable|string|max:500',
            'notes' => 'nullable|string',
        ]);

        $booking->update($request->only([
            'status', 'pickup_time', 'return_time', 'pickup_address',
            'destination_address', 'return_address', 'notes',
        ]));

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::find($id);

        if (! $booking) {
            return redirect()->route('bookings.index')
                ->withErrors(['error' => 'Booking tidak ditemukan']);
        }

        if (! in_array($booking->status, ['pending', 'cancelled'])) {
            return redirect()->route('bookings.index')
                ->withErrors(['error' => 'Tidak dapat menghapus booking dengan status: '.$booking->status]);
        }

        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil dihapus!');
    }

    /**
     * Get price quote without creating booking
     */
    public function getQuote(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_type' => 'required|in:school_transport,rental,general',
            'distance_km' => 'required_unless:service_type,rental|numeric|min:0',
            'children_ids' => 'required_unless:service_type,rental|array|min:1',
            'trip_type' => 'sometimes|in:one_way,two_way',
            'school_id' => 'required_if:service_type,school_transport|exists:schools,id',
            'rental_service_id' => 'required_if:service_type,rental|exists:rental_services,id',
            'hours' => 'required_if:service_type,rental|numeric|min:1',
            'pickup_time' => 'sometimes|date',
            'return_time' => 'sometimes|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $params = $request->all();
            $quote = $this->pricingService->getQuote($request->service_type, $params);

            return response()->json([
                'success' => true,
                'data' => $quote,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to calculate quote: '.$e->getMessage(),
            ], 500);
        }
    }
}
