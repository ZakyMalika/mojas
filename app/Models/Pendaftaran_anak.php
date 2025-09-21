<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran_anak extends Model
{
    /** @use HasFactory<\Database\Factories\PendaftaranAnakFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $table = 'pendaftaran_anak';

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }

    public function tarif_jarak()
    {
        return $this->belongsTo(Tarif_jarak::class, 'tarif_id');
    }
}
