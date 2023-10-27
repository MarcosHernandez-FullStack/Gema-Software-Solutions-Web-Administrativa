<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Models\Servicio;
use Illuminate\Support\Facades\Storage;

class ApiWebInformativaController extends Controller
{

    public function getServicioAll()
    {
        $servicios = Servicio::where('estado', '=', '1')->get();
        return response()->json([
            'res' => true,
            'servicios' => $servicios,
        ], 200);
    }


    /* Alternativa */
    public function getHome()
    {
        $servicios = Servicio::where('estado', '=', '1')->get();
        $ultimosProyectos = Proyecto::where('estado', '=', '1')->orderBy('id', 'desc')->get();


        return response()->json([
            'res' => true,
            'servicios' => $servicios->map(function ($servicio) {
                return [
                    "id" => $servicio->id,
                    "nombre" => $servicio->nombre,
                    "descripcion_resumida" => $servicio->descripcion_resumida,
                    "descripcion_amplia" => $servicio->descripcion_amplia,
                    "estado" => $servicio->estado,
                    "ruta_foto_principal" =>  env("APP_URL") . Storage::url($servicio->ruta_foto_principal),
                    "ruta_foto_secundaria" =>  env("APP_URL") . Storage::url($servicio->ruta_foto_secundaria),

                    /* "ruta_foto" => env("APP_URL") . "storage/" . $servicio->ruta_foto, */
                ];
            }),
            'ultimosProyectos' => $ultimosProyectos->map(function ($proyecto) {
                $fecha_implementacion = date('m/Y', strtotime($proyecto->fecha_implementacion));
                return [
                    "id" => $proyecto->id,
                    "nombre" => $proyecto->nombre,
                    "servicio_id" => $proyecto->servicio->id,
                    //"empresa_id" => $proyecto->empresa_id,
                    "fecha_implementacion" => $fecha_implementacion,
                    "estado" => $proyecto->estado,
                    "ruta_foto" =>  env("APP_URL") . Storage::url($proyecto->ruta_foto),
                    
                    "servicio" => $proyecto->servicio->nombre,
                    "empresa_cliente" => $proyecto->empresa->razon_social,
                    "sub_servicio_detalle" => $proyecto->detalles_proyecto->map(function ($detalle) {
                        return [
                            "id" => $detalle->id,
                            "estado" => $detalle->estado,
                            "nombre" => $detalle->nombre,
                            "ruta_foto" =>   env("APP_URL") . Storage::url($detalle->ruta_foto),
                            "proyecto_id"=>$detalle->proyecto_id,
                        ];
                    }),

                    /*"id" => $proyecto->id,
                    "nombre" => $proyecto->nombre,
                    "servicio_id" => $proyecto->servicio->id,
                    //"empresa_id" => $proyecto->empresa_id,
                    "fecha_implementacion" => $fecha_implementacion,
                    "estado" => $proyecto->estado,
                    "ruta_foto" =>  env("APP_URL") . Storage::url($proyecto->ruta_foto),
                    
                    "servicio" => $proyecto->servicio->descripcion,
                    "empresa_cliente" => $proyecto->empresa_cliente,
                    
                    

                    "sub_servicio_detalle" => $proyecto->sub_servicio_detalles->map(function ($detalle) {
                        return [
                            "id" => $detalle->id,
                            "estado" => $detalle->estado,
                            "descripcion" => $detalle->descripcion,
                            "ruta_foto" =>   env("APP_URL") . Storage::url($detalle->ruta_foto),
                        ];
                    }),*/


                    /* "ruta_foto" => env("APP_URL") . "storage/" . $servicio->ruta_foto, */
                ];
            }),
        ], 200);
    }

    public function getServicioPorId($id)
    {
        $servicio = Servicio::findOrFail($id);
        $listaServicios = Servicio::where('estado', '=', '1')->get();
        $ultimosProyectos = Proyecto::where('estado', '=', '1')
            ->where('servicio_id', '=', $id)
            ->orderBy('id', 'desc')->get();


        return response()->json([
            "servicio" => [
                "id" => $servicio->id,
                "nombre" => $servicio->nombre,
                "descripcion_amplia" => $servicio->descripcion_amplia,
                "estado" => $servicio->estado,
                "ruta_foto_principal" =>  env("APP_URL") . Storage::url($servicio->ruta_foto_principal),
                "ruta_foto_secundaria" =>  env("APP_URL") . Storage::url($servicio->ruta_foto_secundaria),
                "beneficios" => $servicio->beneficios
            ],

            "listaServicios" => $listaServicios->map(function ($servicioItem) use ($servicio) {
                $bEstado = $servicioItem->id === $servicio->id; // Compara los IDs
                return [
                    "id" => $servicioItem->id,
                    "nombre" => $servicioItem->nombre,
                    "estado" => $servicioItem->estado,
                    "bEstado" => $bEstado,
                ];
            }),

            'ultimosProyectos' => $ultimosProyectos->map(function ($proyecto) {
                $fecha_implementacion = date('m/Y', strtotime($proyecto->fecha_implementacion));
                return [
                    "id" => $proyecto->id,
                    "nombre" => $proyecto->nombre,
                    "servicio" => $proyecto->servicio->nombre,
                    "empresa_cliente" => $proyecto->empresa->razon_social,
                    "fecha_implementacion" => $fecha_implementacion,
                    "estado" => $proyecto->estado,
                    "ruta_foto" =>  env("APP_URL") . Storage::url($proyecto->ruta_foto),

                    "sub_servicio_detalle" => $proyecto->detalles_proyecto->map(function ($detalle) {
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

    public function getProyectos(Request $request)
    {
        $pagina = $request->input('pagina');
        
        $proyectos = Proyecto::where('estado', '=', '1')->orderBy('id', 'desc')->paginate(3,['*'], 'pagina', $pagina);

        //return $ultimosProyectos->toJson();
        return response()->json([
            'res' => true,
            'proyectos' => $proyectos->map(function ($proyecto) {
                $fecha_implementacion = date('m/Y', strtotime($proyecto->fecha_implementacion));
                return [
                    "id" => $proyecto->id,
                    "nombre" => $proyecto->nombre,
                    "servicio_id" => $proyecto->servicio->id,
                    //"empresa_id" => $proyecto->empresa_id,
                    "fecha_implementacion" => $fecha_implementacion,
                    "estado" => $proyecto->estado,
                    "ruta_foto" =>  env("APP_URL") . Storage::url($proyecto->ruta_foto),
                    
                    "servicio" => $proyecto->servicio->nombre,
                    "empresa_cliente" => $proyecto->empresa->razon_social,
                    "sub_servicio_detalle" => $proyecto->detalles_proyecto->map(function ($detalle) {
                        return [
                            "id" => $detalle->id,
                            "estado" => $detalle->estado,
                            "nombre" => $detalle->nombre,
                            "ruta_foto" =>   env("APP_URL") . Storage::url($detalle->ruta_foto),
                            "proyecto_id"=>$detalle->proyecto_id,
                        ];
                    }),

                ];
            }),
            'paginacion' => [
                'actual' => $proyectos->currentPage(),
                'total' => $proyectos->lastPage(),
            ],
        ], 200);
       
    }

}
