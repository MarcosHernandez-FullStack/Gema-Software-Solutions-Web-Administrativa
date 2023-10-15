<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;

class ApiWebInformativaController extends Controller
{
    
    public function getServicioAll()
    {
        $servicios=Servicio::where('estado','=','ACTIVO')->get();
        return response()->json([
            'res' => true,
            'servicios' => $servicios, 
        ], 200);
    }
}
