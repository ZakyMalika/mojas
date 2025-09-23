<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\RentalService;
use App\Models\Tarif_jarak;
use App\Services\PricingService;

class PricingController extends Controller
{
    protected $pricingService;

    public function __construct(PricingService $pricingService)
    {
        $this->pricingService = $pricingService;
    }

    /**
     * Show pricing calculator page
     */
    public function calculator()
    {
        $schools = School::where('is_active', true)->orderBy('name')->get();
        $rentalServices = RentalService::where('is_active', true)->orderBy('name')->get();
        $tarifJaraks = Tarif_jarak::where('is_active', true)->orderBy('min_distance_km')->get();
        
        return view('pricing.calculator', compact('schools', 'rentalServices', 'tarifJaraks'));
    }

    /**
     * Get price quote via AJAX
     */
    public function getQuote(Request $request)
    {
        $request->validate([
            'service_type' => 'required|in:school_transport,rental,general',
            'distance_km' => 'required_unless:service_type,rental|numeric|min:0',
            'children_count' => 'required_unless:service_type,rental|integer|min:1',
            'trip_type' => 'sometimes|in:one_way,two_way',
            'school_id' => 'required_if:service_type,school_transport|exists:schools,id',
            'rental_service_id' => 'required_if:service_type,rental|exists:rental_services,id',
            'hours' => 'required_if:service_type,rental|numeric|min:1',
        ]);
        
        try {
            // Prepare parameters for pricing service
            $params = [
                'distance_km' => $request->distance_km,
                'children_ids' => range(1, $request->children_count ?? 1), // Dummy children IDs
                'trip_type' => $request->trip_type ?? 'one_way',
            ];
            
            if ($request->service_type === 'school_transport') {
                $params['school_id'] = $request->school_id;
            } elseif ($request->service_type === 'rental') {
                $params['rental_service_id'] = $request->rental_service_id;
                $params['hours'] = $request->hours;
            }
            
            $quote = $this->pricingService->getQuote($request->service_type, $params);
            
            return response()->json([
                'success' => true,
                'data' => $quote
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show tariff management page
     */
    public function tariffs()
    {
        $tariffs = Tarif_jarak::orderBy('min_distance_km')->get();
        
        return view('pricing.tariffs', compact('tariffs'));
    }

    /**
     * Show pricing tiers management page
     */
    public function tiers()
    {
        $tiers = \App\Models\PricingTier::where('is_active', true)->get();
        
        return view('pricing.tiers', compact('tiers'));
    }

    /**
     * Show pricing rules explanation
     */
    public function rules()
    {
        return view('pricing.rules');
    }
}
