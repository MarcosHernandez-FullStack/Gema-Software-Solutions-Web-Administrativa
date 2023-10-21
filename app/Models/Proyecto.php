<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;
    protected $table = 'proyecto';
    protected $guarded = [];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function detalles_proyecto()
    {
        return $this->hasMany(DetalleProyecto::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
