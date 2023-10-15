<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\BienvenidoComponent;
use App\Http\Livewire\Servicio\ServicioComponent;
use App\Http\Livewire\SubServicio\SubServicioComponent;
use App\Http\Livewire\SubServicioDetalle\SubServicioDetalleComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', BienvenidoComponent::class)->name('bienvenido');
Route::get('/servicios', ServicioComponent::class)->name('servicios');
Route::get('/subservicios/{servicio_id}', SubServicioComponent::class)->name('subservicios');
Route::get('/subserviciosdetalle/{sub_servicio_id}', SubServicioDetalleComponent::class)->name('subserviciodetalles');
