<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model
{
    use HasFactory;

    protected $table = 'beneficio';
    protected $guarded = [];

    public function beneficios_servicios()
    {
        return $this->hasMany(BeneficioServicio::class);
    }

    
}
