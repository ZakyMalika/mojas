<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif_jarak extends Model
{
    /** @use HasFactory<\Database\Factories\TarifJarakFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $table = 'tarif_jarak';

    public function pendaftaran_anak()
    {
        return $this->hasMany(Pendaftaran_anak::class, 'tarif_id');
    }
}
