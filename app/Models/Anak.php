<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    /** @use HasFactory<\Database\Factories\AnakFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $table = 'anak';

    public function orangTua()
    {
        return $this->belongsTo(Orang_tua::class);
    }
}
