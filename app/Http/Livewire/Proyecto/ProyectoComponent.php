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
    public $servicio_id,$proyecto,$ruta_foto,$foto_guardada;
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
        $this->paginacion = 3;
        $this->paginationTheme = 'bootstrap';
        $this->proyecto=new Proyecto();
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
        $this->dispatchBrowserEvent('closeModal');
    }

    //FUNCION PARA CAMBIAR EL ESTADO DEL MODELO
    public function cambiarEstado($id){
        $proyecto = Proyecto::find($id);
        if($proyecto->estado == 1){
            $proyecto->update(['estado' => '0']);
        }else{
            $proyecto->update(['estado' => '1']);
        }
        session()->flash('message', 'Estado del Proyecto actualizado con éxito');    //ENVIAR MENSAJE DE CONFIRMACION
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
        if($this->ruta_foto!=$this->proyecto->ruta_foto) $this->proyecto->ruta_foto = $this->ruta_foto->store('public/proyectos');
        $this->proyecto->update();
        session()->flash('message', 'Proyecto actualizado con éxito');
        $this->dispatchBrowserEvent('closeModal');
    }

}
