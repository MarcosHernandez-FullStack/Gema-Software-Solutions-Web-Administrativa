<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    protected $table = 'servicio';
    protected $guarded = [];

    public function sub_servicios()
    {
        return $this->hasMany(SubServicio::class);
    }
}
