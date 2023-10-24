<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicio';
    protected $guarded = [];

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }
    public function beneficios()
    {
        return $this->belongsToMany(Beneficio::class, 'beneficio_servicio', 'servicio_id', 'beneficio_id');
    }

    public function beneficios_servicios()
    {
        return $this->hasMany(BeneficioServicio::class);
    }

}
