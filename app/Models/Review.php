<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected $fillable = [
        'nama',
        'ulasan', 
        'rating'
    ];

    protected $casts = [
        'rating' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Scope untuk mengambil review dengan rating tinggi
    public function scopeHighRated($query)
    {
        return $query->where('rating', '>=', 4);
    }

    // Scope untuk mengambil review terbaru
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Accessor untuk format tanggal Indonesia
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d F Y');
    }

    // Accessor untuk mendapatkan array bintang
    public function getStarsArrayAttribute()
    {
        return range(1, $this->rating);
    }
}
