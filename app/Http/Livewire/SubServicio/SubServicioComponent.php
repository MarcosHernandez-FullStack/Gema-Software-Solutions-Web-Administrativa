<?php

namespace App\Http\Livewire\SubServicio;


use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\SubServicio;
use App\Models\Servicio;

class SubServicioComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $servicio_id,$sub_servicio,$ruta_foto;
    public $search, $sort, $direction;
    public $form, $vista;
    public $paginacion, $paginationTheme;

    //CONSTRUCTOR EN DONDE SE INICIALIZAN VARIABLES
    public function mount($servicio_id)
    {
        $this->servicio_id=$servicio_id;
        /* $this->sub_servicio = new SubServicio();
        $this->sub_servicio->servicio_id=$this->servicio_id; */
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
           'sub_servicio.servicio_id' => 'required',
           'sub_servicio.descripcion' => 'required',
           'sub_servicio.fecha_implementacion' => 'required',
           'sub_servicio.empresa_cliente' => 'required',
           'ruta_foto' => 'required|image|max:2048',
        ];
   }

   //PROPIEDAD PARA PERSONALIZAR MENSAJES DE VALIDACION
   protected $messages = [
       'sub_servicio.descripcion.required' => 'La descripcion es requerida',
       'sub_servicio.fecha_implementacion.required' => 'La fecha implementacion es requerida',
       'sub_servicio.empresa_cliente.required' => 'La empresa cliente es requerida',
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
           $this->sub_servicio = new SubServicio();
           $this->sub_servicio->servicio_id=$this->servicio_id;
           $this->reset('ruta_foto');
       }
       $this->vista = $vista;
       $this->form = $form;
   }

    public function render()
    {
        $sub_servicios=SubServicio::where('estado','=','ACTIVO')->get();
        $servicio=Servicio::find($this->servicio_id);
        return view('livewire.sub-servicio.sub-servicio-component', compact('sub_servicios','servicio'))
                ->extends('layouts.principal')
                ->section('content');
    }


    //FUNCION PARA GUARDAR EN BASE DE DATOS
    public function save(){
        $this->validate();
         //GUARDAR FOTO
         if($this->ruta_foto){
            $this->sub_servicio->ruta_foto = $this->ruta_foto->store('public/subservicios');
        }
        $this->sub_servicio->save();
        session()->flash('message', 'Sub servicio registrado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }

    //FUNCION PARA REDIRIGIR AL SUBSERVICIODETALLE
    public function rediregirSubservicioDetalles($sub_servicio_id){
        return redirect()->route('subserviciodetalles', ['sub_servicio_id' => $sub_servicio_id]);
    }
}
