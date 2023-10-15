<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubServicioDetalle extends Model
{
    use HasFactory;
    protected $table = 'sub_servicio_detalle';
    protected $guarded = [];

    public function sub_servicio()
    {
        return $this->belongsTo(SubServicio::class);
    }
}
