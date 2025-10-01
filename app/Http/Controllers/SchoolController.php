<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $schools = School::with('children')->paginate(15);
        $children = Anak::with('school', 'orangTua.user')->get();

        return view('admin.schools.index', compact('schools', 'children'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.schools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:sekolah,umum',
            'address' => 'nullable|string',
            'has_partnership' => 'boolean',
            'partnership_rate' => 'nullable|numeric|min:0',
            'one_way_price' => 'nullable|numeric|min:0',
            'two_way_price' => 'nullable|numeric|min:0',
            'general_rate' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $school = School::create($request->all());

        return redirect()->route('admin.schools.show', $school->id)
            ->with('success', 'Sekolah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $school = School::find($id);

        if (! $school) {
            return redirect()->route('admin.schools.index')
                ->withErrors(['error' => 'Sekolah tidak ditemukan']);
        }

        // Get bookings for this school
        $recentBookings = $school->bookings()
            ->with('orangTua')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.schools.show', compact('school', 'recentBookings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $school = School::find($id);

        if (! $school) {
            return redirect()->route('schools.index')
                ->withErrors(['error' => 'Sekolah tidak ditemukan']);
        }

        return view('admin.schools.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $school = School::find($id);

        if (! $school) {
            return redirect()->route('schools.index')
                ->withErrors(['error' => 'Sekolah tidak ditemukan']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:sekolah,umum',
            'address' => 'nullable|string',
            'has_partnership' => 'boolean',
            'partnership_rate' => 'nullable|numeric|min:0',
            'one_way_price' => 'nullable|numeric|min:0',
            'two_way_price' => 'nullable|numeric|min:0',
            'general_rate' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $school->update($request->all());

        return redirect()->route('admin.schools.show', $school->id)
            ->with('success', 'Sekolah berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $school = School::find($id);

        if (! $school) {
            return redirect()->route('admin.schools.index')
                ->withErrors(['error' => 'Sekolah tidak ditemukan']);
        }

        // Check if school has bookings
        if ($school->bookings()->count() > 0) {
            return redirect()->route('schools.index')
                ->withErrors(['error' => 'Tidak dapat menghapus sekolah yang masih memiliki booking']);
        }

        $school->delete();

        return redirect()->route('admin.schools.index')
            ->with('success', 'Sekolah berhasil dihapus!');
    }
}
