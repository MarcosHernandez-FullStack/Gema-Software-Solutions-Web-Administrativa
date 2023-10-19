<?php

namespace App\Http\Livewire\Servicio;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\Servicio;
use App\Models\Beneficio;
use Illuminate\Database\Eloquent\Collection;

class ServicioComponent extends Component
{

    use WithPagination, WithFileUploads;
    public $servicio,$ruta_foto_principal,$ruta_foto_secundaria,$beneficios_collection,$beneficio_id=-1;
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
        $this->beneficios_collection = new Collection();
    }

     //FUNCION PARA RESETEAR NUMERO DE PAGINACION
     public function updatingSearch(){
        $this->resetPage();
    }

    //FUNCION PARA REGISTRAR LAS VALIDACIONES DINAMICAS
    protected function rules(){
        return [
           'servicio.nombre' => 'required',
           'servicio.descripcion_resumida' => 'required',
           'servicio.descripcion_amplia' => 'required',
           'ruta_foto_principal' => 'required|image|max:2048',
           'ruta_foto_secundaria' => 'required|image|max:2048',

        ];
   }

   //PROPIEDAD PARA PERSONALIZAR MENSAJES DE VALIDACION
   protected $messages = [
       'servicio.descripcion.required' => 'La descripcion es requerida',
       'servicio.descripcion_resumida.required' => 'El detalle de la descripcion resumida es requerida',
       'servicio.descripcion_amplia.required' => 'El detalle de la descripcion amplia es requerida',
       'ruta_foto_principal.required' => 'La foto principal es requerida',
       'ruta_foto_principal.image' => 'El campo foto principal debe ser una imagen',
       'ruta_foto_principal.max' => 'El campo foto principal debe tener un tamaño maximo de 2MB',
       'ruta_foto_secundaria.required' => 'La foto del detalle es requerida',
       'ruta_foto_secundaria.image' => 'El campo foto del detalle debe ser una imagen',
       'ruta_foto_secundaria.max' => 'El campo foto del detalle debe tener un tamaño maximo de 2MB',
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
           $this->reset('ruta_foto_principal');
           $this->beneficios_collection = new Collection();
       }
       $this->vista = $vista;
       $this->form = $form;
   }

    public function render()
    {
        $servicios=Servicio::all();
        $beneficios=Beneficio::where('estado','=','ACTIVO')->get();
        return view('livewire.servicio.servicio-component', compact('servicios','beneficios'))
                ->extends('layouts.principal')
                ->section('content');
    }


    //FUNCION PARA GUARDAR EN BASE DE DATOS
    public function save(){
        $this->validate();
         //GUARDAR FOTO
         if($this->ruta_foto_principal && $this->ruta_foto_secundaria){
            $this->servicio->ruta_foto_principal = $this->ruta_foto_principal->store('public/servicios/principal');
            $this->servicio->ruta_foto_secundaria = $this->ruta_foto_secundaria->store('public/servicios/secundaria');
        }
        $servicioCreado= new Servicio();
        $servicioCreado=$this->servicio;
        $servicioCreado->save();
        foreach($this->beneficios_collection as $beneficio)
        {
            $servicioCreado->beneficios()->attach($beneficio);
        }
        session()->flash('message', 'Servicio registrado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }

    //FUNCION PARA AGREGAR ELEMENTOS AL beneficio_collection
    public function addBeneficioCollection($beneficio_id){
        $beneficio=Beneficio::find($beneficio_id);
        $this->beneficios_collection->push($beneficio);
        $this->reset('beneficio_id');
    }

     //FUNCION PARA ELIMINAR ELEMENTOS DEL beneficio_collection
     public function deleteBeneficioCollection($indiceElemento){
        $this->beneficios_collection->pull($indiceElemento); // Elimina el elemento en el índice $indiceElemento y lo devuelve
    }

    public function imprimir()
    {
        dd($this->beneficios_collection->all());
    }

    //FUNCION PARA REDIRIGIR AL SUBSERVICIO
    public function rediregirProyectos($servicio_id){
        return redirect()->route('proyectos', ['servicio_id' => $servicio_id]);
    }
}
