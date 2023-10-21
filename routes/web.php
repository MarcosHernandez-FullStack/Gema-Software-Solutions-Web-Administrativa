<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\BienvenidoComponent;
use App\Http\Livewire\Diseño\DiseñoComponent;
use App\Http\Livewire\Servicio\ServicioComponent;
use App\Http\Livewire\Proyecto\ProyectoComponent;
use App\Http\Livewire\InicioSesion\InicioSesionComponent;

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
Route::get('/', InicioSesionComponent::class)->name('iniciosesion');
Route::get('/bienvenido', BienvenidoComponent::class)->name('bienvenido');
Route::get('/servicios', ServicioComponent::class)->name('servicios');
Route::get('/proyectos/{servicio_id}', ProyectoComponent::class)->name('proyectos');

Route::get('/diseños', DiseñoComponent::class)->name('diseños');