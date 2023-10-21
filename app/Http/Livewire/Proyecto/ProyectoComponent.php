<?php

namespace App\Http\Livewire\Proyecto;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\Proyecto;
use App\Models\Servicio;
use App\Models\Empresa;

class ProyectoComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $servicio_id,$proyecto,$ruta_foto;
    public $search, $sort, $direction;
    public $form, $vista;
    public $paginacion, $paginationTheme;


    //CONSTRUCTOR EN DONDE SE INICIALIZAN VARIABLES
    public function mount($servicio_id)
    {
        $this->servicio_id=$servicio_id;
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
           'proyecto.servicio_id' => 'required',
           'proyecto.nombre' => 'required',
           'proyecto.fecha_implementacion' => 'required',
           'proyecto.empresa_id' => 'required',
           'ruta_foto' => 'required|image|max:2048',
        ];
   }

   //PROPIEDAD PARA PERSONALIZAR MENSAJES DE VALIDACION
   protected $messages = [
       'proyecto.nombre.required' => 'La nombre es requerida',
       'proyecto.fecha_implementacion.required' => 'La fecha implementacion es requerida',
       'proyecto.empresa_id.required' => 'La empresa cliente es requerida',
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
           $this->proyecto = new Proyecto();
           $this->proyecto->servicio_id=$this->servicio_id;
           $this->reset('ruta_foto');
       }
       $this->vista = $vista;
       $this->form = $form;
   }


    public function render()
    {
        $proyectos=Proyecto::where('servicio_id','=',$this->servicio_id)->get();
        $servicio=Servicio::find($this->servicio_id);
        $empresas=Empresa::where('estado','=',1)->get();
        return view('livewire.proyecto.proyecto-component', compact('proyectos','servicio','empresas'))
                ->extends('layouts.principal')
                ->section('content');
    }

     //FUNCION PARA GUARDAR EN BASE DE DATOS
     public function save(){
        $this->validate();
         //GUARDAR FOTO
         if($this->ruta_foto){
            $this->proyecto->ruta_foto = $this->ruta_foto->store('public/proyectos');
        }
        $this->proyecto->save();
        session()->flash('message', 'Proyecto registrado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }
}
