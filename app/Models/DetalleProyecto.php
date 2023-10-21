<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleProyecto extends Model
{
    use HasFactory;
    protected $table = 'detalle_proyecto';
    protected $guarded = [];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
