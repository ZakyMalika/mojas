<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Menampilkan halaman home dengan daftar review
     */
    public function home()
    {
        // Ambil review terbaru dengan rating tinggi untuk ditampilkan di homepage
        $reviews = Review::highRated()
            ->latest()
            ->take(6) // Ambil 6 review teratas
            ->get();

        // Statistik review
        $totalReviews = Review::count();
        $averageRating = Review::avg('rating') ?? 0;

        return view('frontend.home', compact('reviews', 'totalReviews', 'averageRating'));
    }

    /**
     * Menyimpan review baru dari form
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'ulasan' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5'
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'ulasan.required' => 'Ulasan harus diisi',
            'ulasan.max' => 'Ulasan maksimal 1000 karakter',
            'rating.required' => 'Rating harus dipilih',
            'rating.min' => 'Rating minimal 1 bintang',
            'rating.max' => 'Rating maksimal 5 bintang'
        ]);

        try {
            $review = Review::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Terima kasih! Ulasan Anda telah berhasil dikirim.',
                'review' => [
                    'nama' => $review->nama,
                    'ulasan' => $review->ulasan,
                    'rating' => $review->rating,
                    'formatted_date' => $review->formatted_date
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan ulasan. Silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Mengambil daftar review untuk AJAX
     */
    public function getReviews(Request $request)
    {
        $perPage = $request->get('per_page', 6);
        $page = $request->get('page', 1);

        $reviews = Review::latest()
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $reviews->items(),
            'pagination' => [
                'current_page' => $reviews->currentPage(),
                'last_page' => $reviews->lastPage(),
                'total' => $reviews->total(),
                'has_more' => $reviews->hasMorePages()
            ]
        ]);
    }

    /**
     * Mendapatkan statistik review
     */
    public function getStats()
    {
        $stats = [
            'total_reviews' => Review::count(),
            'average_rating' => round(Review::avg('rating'), 1),
            'rating_distribution' => [
                5 => Review::where('rating', 5)->count(),
                4 => Review::where('rating', 4)->count(),
                3 => Review::where('rating', 3)->count(),
                2 => Review::where('rating', 2)->count(),
                1 => Review::where('rating', 1)->count(),
            ]
        ];

        return response()->json($stats);
    }
}
