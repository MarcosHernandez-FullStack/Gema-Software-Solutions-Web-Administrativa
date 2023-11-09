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
    public $servicio_id,$proyecto,$ruta_foto,$foto_guardada,$mensajeListado;
    public $search, $sort, $direction;
    public $form, $vista;
    protected $paginationTheme = 'bootstrap';
    public $paginacion = 6;

    //CONSTRUCTOR EN DONDE SE INICIALIZAN VARIABLES
    public function mount($servicio_id)
    {
        $this->servicio_id=$servicio_id;
        $this->sort ='id';
        $this->direction ='asc';
        $this->form = 'create'; //create, update
        $this->vista = 'form'; //form
       /*  $this->paginacion = 3;
        $this->paginationTheme = 'bootstrap'; */
        $this->proyecto=new Proyecto();
    }

     //FUNCION PARA RESETEAR NUMERO DE PAGINACION
     public function updatingSearch(){
        $this->resetPage();
    }

   /*  public function updatedProyecto()
    {
        $this->emitTo('DetalleProyectoComponent', 'getProyectoId', $this->proyecto->id);
    } */

    //FUNCION PARA REGISTRAR LAS VALIDACIONES DINAMICAS
    protected function rules(){
        $rules=[
            'proyecto.servicio_id' => 'required',
            'proyecto.nombre' => 'required|max:40',
            'proyecto.fecha_implementacion' => 'required|before:2041-01-01|after:2018-03-31',
            'proyecto.empresa_id' => 'required',
        ];
        if ((!is_null($this->ruta_foto) && $this->form!=='update')||$this->form=='create') 
        {
            $rules['ruta_foto'] = 'required|image|max:2048';
        }
        return $rules;
   }

   //PROPIEDAD PARA PERSONALIZAR MENSAJES DE VALIDACION
   protected $messages = [
       'proyecto.nombre.required' => 'El campo nombre es requerido',
       'proyecto.nombre.max' => 'El campo nombre acepta como máximo 40 caracteres',
       'proyecto.fecha_implementacion.required' => 'El campo fecha implementación es requerida',
       'proyecto.fecha_implementacion.before' => 'Fecha como máximo 31/12/2040',
       'proyecto.fecha_implementacion.after' => 'Fecha como mínimo 01/04/2018',
       'proyecto.empresa_id.required' => 'La campo empresa cliente es requerido',
       'ruta_foto.required' => 'El campo foto es requerido',
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
        $proyectos=Proyecto::where('nombre', 'like', '%'.$this->search.'%')
                            ->where('servicio_id','=',$this->servicio_id)->paginate($this->paginacion);
        $servicio=Servicio::find($this->servicio_id);
        $empresas=Empresa::where('estado','=','1')->get();
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
        $this->mensajeListado= ['message'=>session('message'),'color'=>'success'];
        $this->dispatchBrowserEvent('closeModal');
    }

    //FUNCION PARA CAMBIAR EL ESTADO DEL MODELO
    public function cambiarEstado($id){
        $proyecto = Proyecto::find($id);
        if($proyecto->estado == 1){
            $proyecto->update(['estado' => '0']);
            session()->flash('message', 'Proyecto desactivado');
            $this->mensajeListado = ['message'=>session('message'),'color'=>'warning'];
        }else{
            $proyecto->update(['estado' => '1']);
            session()->flash('message', 'Proyecto activado');
            $this->mensajeListado = ['message'=>session('message'),'color'=>'success'];
        }
    }

    //FUNCION PARA CONSULTAR EN BASE DE DATOS Y LLENAR LOS CAMPOS DEL FORMULARIO
    public function edit($id){
        $this->showModal("form", "update");
        $this->proyecto=Proyecto::find($id);
        /* $this->ruta_foto=$this->proyecto->ruta_foto; */
        $this->foto_guardada = $this->proyecto->ruta_foto;
    }

    public function update(){
        $this->validate();
        if(!is_null($this->ruta_foto) && $this->ruta_foto!=$this->proyecto->ruta_foto) 
        {
            Storage::delete($this->proyecto->ruta_foto);
            $this->proyecto->ruta_foto = $this->ruta_foto->store('public/proyectos');
        }
        $this->proyecto->update();
        session()->flash('message', 'Proyecto actualizado con éxito');
        $this->mensajeListado= ['message'=>session('message'),'color'=>'success'];
        $this->dispatchBrowserEvent('closeModal');
    }

    //FUNCIÓN PARA RESETEAR EL LA VARIABLE QUE ALBERGA AL MENSAJE AL PULSAR EN EL CLOSE DEL MENSAJE
    public function resetearMensaje($contenedor_mensaje){
        $this->reset($contenedor_mensaje);
    }
}
