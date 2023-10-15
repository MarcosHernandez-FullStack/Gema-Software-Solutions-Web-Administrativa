<?php

namespace App\Http\Livewire\SubServicioDetalle;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\SubServicio;
use App\Models\SubServicioDetalle;

class SubServicioDetalleComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $sub_servicio_id,$sub_servicio_detalle,$ruta_foto;
    public $search, $sort, $direction;
    public $form, $vista;
    public $paginacion, $paginationTheme;


    //CONSTRUCTOR EN DONDE SE INICIALIZAN VARIABLES
    public function mount($sub_servicio_id)
    {
        $this->sub_servicio_id=$sub_servicio_id;
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
           'sub_servicio_detalle.sub_servicio_id' => 'required',
           'sub_servicio_detalle.descripcion' => 'required',
           'ruta_foto' => 'required|image|max:2048',
        ];
   }

   //PROPIEDAD PARA PERSONALIZAR MENSAJES DE VALIDACION
   protected $messages = [
       'sub_servicio_detalle.descripcion.required' => 'La descripcion es requerida',
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
           $this->sub_servicio_detalle = new SubServicioDetalle();
           $this->sub_servicio_detalle->sub_servicio_id=$this->sub_servicio_id;
           $this->reset('ruta_foto');
       }
       $this->vista = $vista;
       $this->form = $form;
   }

    public function render()
    {
        $sub_servicio_detalles=SubServicioDetalle::where('estado','=','ACTIVO')->get();
        $sub_servicio=SubServicio::find($this->sub_servicio_id);
        return view('livewire.sub-servicio-detalle.sub-servicio-detalle-component',compact('sub_servicio_detalles','sub_servicio'))
                ->extends('layouts.principal')
                ->section('content');
    }

    //FUNCION PARA GUARDAR EN BASE DE DATOS
    public function save(){
        $this->validate();
         //GUARDAR FOTO
         if($this->ruta_foto){
            $this->sub_servicio_detalle->ruta_foto = $this->ruta_foto->store('subserviciodetalles');
        }
        $this->sub_servicio_detalle->save();
        session()->flash('message', 'Detalle de Sub servicio registrado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }
}
