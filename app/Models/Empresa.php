<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $table = 'empresa';
    protected $guarded = [];

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }

}
