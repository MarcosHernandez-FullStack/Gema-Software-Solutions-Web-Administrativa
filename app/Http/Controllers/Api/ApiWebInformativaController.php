<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\SubServicio;
use Illuminate\Support\Facades\Storage;

class ApiWebInformativaController extends Controller
{

    public function getServicioAll()
    {
        $servicios = Servicio::where('estado', '=', 'ACTIVO')->get();
        return response()->json([
            'res' => true,
            'servicios' => $servicios,
        ], 200);
    }


    /* Alternativa */
    public function getHome()
    {
        $servicios = Servicio::where('estado', '=', 'ACTIVO')->get();
        $ultimosProyectos = SubServicio::where('estado', '=', 'ACTIVO')->orderBy('id', 'desc')->get();


        return response()->json([
            'res' => true,
            'servicios' => $servicios->map(function ($servicio) {
                return [
                    "id" => $servicio->id,
                    "descripcion" => $servicio->descripcion,
                    "detalle_descripcion_resumida" => $servicio->detalle_descripcion_resumida,
                    "detalle_descripcion_amplia" => $servicio->detalle_descripcion_amplia,
                    "estado" => $servicio->estado,
                    "ruta_foto_principal" =>  env("APP_URL") . Storage::url($servicio->ruta_foto_principal),
                    "ruta_foto_detalle" =>  env("APP_URL") . Storage::url($servicio->ruta_foto_detalle),

                    /* "ruta_foto" => env("APP_URL") . "storage/" . $servicio->ruta_foto, */
                ];
            }),
            'ultimosProyectos' => $ultimosProyectos->map(function ($proyecto) {
                $fecha_implementacion = date('m/Y', strtotime($proyecto->fecha_implementacion));
                return [
                    "id" => $proyecto->id,
                    "descripcion" => $proyecto->descripcion,
                    "servicio_id" => $proyecto->servicio->id,
                    "servicio" => $proyecto->servicio->descripcion,
                    "empresa_cliente" => $proyecto->empresa_cliente,
                    "fecha_implementacion" => $fecha_implementacion,
                    "estado" => $proyecto->estado,
                    "ruta_foto" =>  env("APP_URL") . Storage::url($proyecto->ruta_foto),

                    "sub_servicio_detalle" => $proyecto->sub_servicio_detalles->map(function ($detalle) {
                        return [
                            "id" => $detalle->id,
                            "estado" => $detalle->estado,
                            "descripcion" => $detalle->descripcion,
                            "ruta_foto" =>   env("APP_URL") . Storage::url($detalle->ruta_foto),
                        ];
                    }),


                    /* "ruta_foto" => env("APP_URL") . "storage/" . $servicio->ruta_foto, */
                ];
            }),
        ], 200);
    }

    public function getServicioPorId($id)
    {
        $servicio = Servicio::findOrFail($id);
        $listaServicios = Servicio::where('estado', '=', 'ACTIVO')->get();
        $ultimosProyectos = SubServicio::where('estado', '=', 'ACTIVO')
            ->where('servicio_id', '=', $id)
            ->orderBy('id', 'desc')->get();


        return response()->json([
            "servicio" => [
                "id" => $servicio->id,
                "descripcion" => $servicio->descripcion,
                "detalle_descripcion_amplia" => $servicio->detalle_descripcion_amplia,
                "estado" => $servicio->estado,
                "ruta_foto_principal" =>  env("APP_URL") . Storage::url($servicio->ruta_foto_principal),
                "ruta_foto_detalle" =>  env("APP_URL") . Storage::url($servicio->ruta_foto_detalle),
                "beneficios" => $servicio->beneficios
            ],

            "listaServicios" => $listaServicios->map(function ($servicioItem) use ($servicio) {
                $bEstado = $servicioItem->id === $servicio->id; // Compara los IDs
                return [
                    "id" => $servicioItem->id,
                    "descripcion" => $servicioItem->descripcion,
                    "estado" => $servicioItem->estado,
                    "bEstado" => $bEstado,
                ];
            }),

            'ultimosProyectos' => $ultimosProyectos->map(function ($proyecto) {
                $fecha_implementacion = date('m/Y', strtotime($proyecto->fecha_implementacion));
                return [
                    "id" => $proyecto->id,
                    "descripcion" => $proyecto->descripcion,
                    "servicio" => $proyecto->servicio->descripcion,
                    "empresa_cliente" => $proyecto->empresa_cliente,
                    "fecha_implementacion" => $fecha_implementacion,
                    "estado" => $proyecto->estado,
                    "ruta_foto" =>  env("APP_URL") . Storage::url($proyecto->ruta_foto),

                    "sub_servicio_detalle" => $proyecto->sub_servicio_detalles->map(function ($detalle) {
                        return [
                            "id" => $detalle->id,
                            "estado" => $detalle->estado,
                            "descripcion" => $detalle->descripcion,
                            "ruta_foto" =>   env("APP_URL") . Storage::url($detalle->ruta_foto),
                        ];
                    }),


                    /* "ruta_foto" => env("APP_URL") . "storage/" . $servicio->ruta_foto, */
                ];
            }),
        ]);
    }
}
