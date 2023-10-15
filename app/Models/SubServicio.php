<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubServicio extends Model
{
    use HasFactory;
    protected $table = 'sub_servicio';
    protected $guarded = [];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
    public function sub_servicio_detalles()
    {
        return $this->hasMany(SubServicioDetalle::class);
    }
}
