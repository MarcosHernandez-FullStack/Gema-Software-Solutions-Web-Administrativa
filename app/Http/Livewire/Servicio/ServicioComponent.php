<?php

namespace App\Http\Livewire\Servicio;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\Servicio;


class ServicioComponent extends Component
{

    use WithPagination, WithFileUploads;
    public $servicio,$ruta_foto;
    public $search, $sort, $direction;
    public $form, $vista;
    public $paginacion, $paginationTheme;

    //CONSTRUCTOR EN DONDE SE INICIALIZAN VARIABLES
    public function mount()
    {
        $this->sort ='id';
        $this->direction ='asc';
        $this->form = 'create'; //create, update
        $this->vista = 'form'; //form
        $this->paginacion = 5;
        $this->paginationTheme = 'bootstrap';
    }

     //FUNCION PARA RESETEAR NUMERO DE PAGINACION
     public function updatingSearch(){
        $this->resetPage();
    }

    //FUNCION PARA REGISTRAR LAS VALIDACIONES DINAMICAS
    protected function rules(){
        return [
           'servicio.descripcion' => 'required',
           'servicio.detalle_descripcion' => 'required',
           'ruta_foto' => 'required|image|max:2048',
        ];
   }

   //PROPIEDAD PARA PERSONALIZAR MENSAJES DE VALIDACION
   protected $messages = [
       'servicio.descripcion.required' => 'La descripcion es requerida',
       'servicio.detalle_descripcion.required' => 'El detalle de la descripcion es requerida',
       'ruta_foto.required' => 'La foto es requerida',
       'ruta_foto.image' => 'El campo foto debe ser una imagen',
       'ruta_foto.max' => 'El campo foto debe tener un tamaño maximo de 2MB',
   ];

   //FUNCION PARA MOSTRAR ERRORES DE VALIDACION EN TIEMPO REAL
   public function updated($propertyName){
       $this->validateOnly($propertyName);
   }

   //FUNCION PARA RESETEAR VARIABLES Y ERRORES DE VALIDACION
   public function resetError(){
       $this->resetErrorBag();
       $this->resetValidation();
   }

   //FUNCION PARA MOSTRAR LA VISTA DEL MODAL
   public function showModal($vista, $form){
       $this->resetError();
       if($form == 'create'){
           $this->servicio = new Servicio();
           $this->reset('ruta_foto');
       }
       $this->vista = $vista;
       $this->form = $form;
   }

    public function render()
    {
        $servicios=Servicio::where('estado','=','ACTIVO')->get();
        return view('livewire.servicio.servicio-component', compact('servicios'))
                ->extends('layouts.principal')
                ->section('content');
    }


    //FUNCION PARA GUARDAR EN BASE DE DATOS
    public function save(){
        $this->validate();
         //GUARDAR FOTO
         if($this->ruta_foto){
            $this->servicio->ruta_foto = $this->ruta_foto->store('public/servicios');
        }
        $this->servicio->save();
        session()->flash('message', 'Servicio registrado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }

    //FUNCION PARA REDIRIGIR AL SUBSERVICIO
    public function rediregirSubservicio($servicio_id){
        return redirect()->route('subservicios', ['servicio_id' => $servicio_id]);
    }





}
