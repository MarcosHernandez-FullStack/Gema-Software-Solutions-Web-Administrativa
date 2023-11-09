<?php

namespace App\Http\Livewire\Servicio;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\Servicio;
use App\Models\Beneficio;
use Illuminate\Database\Eloquent\Collection;
use App\Models\BeneficioServicio;

class ServicioComponent extends Component
{

    use WithPagination;
    use WithFileUploads;
    public $servicio,$ruta_foto_principal,$ruta_foto_secundaria,$beneficios_collection,$beneficio_id=-1,$foto_principal_guardada,$foto_secundaria_guardada,$mensajeForm, $mensajeListado;
    public $search, $sort, $direction;
    public $form, $vista;
    protected $paginationTheme = 'bootstrap';
    public $paginacion = 6;
    /* public $paginacion, $paginationTheme; */

    //CONSTRUCTOR EN DONDE SE INICIALIZAN VARIABLES
    public function mount()
    {
        $this->sort ='id';
        $this->direction ='asc';
        $this->form = 'create'; //create, update
        $this->vista = 'form'; //form
       /*  $this->paginacion = 3;
        $this->paginationTheme = 'bootstrap'; */
        $this->beneficios_collection = new Collection();
        $this->servicio=new Servicio();
    }

     //FUNCION PARA RESETEAR NUMERO DE PAGINACION
     public function updatingSearch(){
        $this->resetPage();
    }

    //FUNCION PARA REGISTRAR LAS VALIDACIONES DINAMICAS
    protected function rules(){
        $rules = [
            'servicio.nombre' => 'required|max:27',
            'servicio.descripcion_resumida' => 'required|max:75',
            'servicio.descripcion_amplia' => 'required|max:725',
        ];
        if ((!is_null($this->ruta_foto_principal) && $this->form!=='update')||$this->form=='create') {
            $rules['ruta_foto_principal'] = 'required|image|max:2048';
        }
        if ((!is_null($this->ruta_foto_secundaria) && $this->form!=='update')||$this->form=='create') {
            $rules['ruta_foto_secundaria'] = 'required|image|max:2048';
        }
        return $rules;
   }

   //PROPIEDAD PARA PERSONALIZAR MENSAJES DE VALIDACION
   protected $messages = [
       'servicio.nombre.required' => 'El campo nombre es requerido',
       'servicio.nombre.max' => 'El campo nombre acepta como máximo 27 caracteres',
       'servicio.descripcion_resumida.required' => 'El detalle de la descripcion resumida es requerida',
       'servicio.descripcion_resumida.max' => 'El campo nombre acepta como máximo 75 caracteres',
       'servicio.descripcion_amplia.required' => 'El detalle de la descripcion amplia es requerida',
       'servicio.descripcion_amplia.max' => 'El campo nombre acepta como máximo 725 caracteres',
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
           $this->reset('ruta_foto_principal','ruta_foto_secundaria');
           $this->beneficios_collection = new Collection();
       }else
       {
            if($form == 'update'){
                $this->reset('ruta_foto_principal','ruta_foto_secundaria','foto_principal_guardada','foto_secundaria_guardada');
            }
       }
       $this->vista = $vista;
       $this->form = $form;
   }

    public function render()
    {
        $servicios=Servicio::where('nombre', 'like', '%'.$this->search.'%')->paginate($this->paginacion);
        $beneficios=Beneficio::where('estado','=','1')->get();
        $servicio_obtenido=Servicio::find($this->servicio->id);
        return view('livewire.servicio.servicio-component', compact('servicios','beneficios','servicio_obtenido'))
                ->extends('layouts.principal')
                ->section('content');
    }


    //FUNCION PARA GUARDAR EN BASE DE DATOS
    public function save(){
        $this->validate();
        if($this->beneficios_collection->count() > 0)
        {
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
            $this->mensajeListado= ['message'=>session('message'),'color'=>'success'];
            $this->dispatchBrowserEvent('closeModal');
        }
        else
        {
            session()->flash('message', 'No hay beneficios');
            $this->mensajeForm = ['message'=>session('message'),'color'=>'danger'];

        }
           
    }

    //FUNCION PARA AGREGAR ELEMENTOS AL beneficio_collection
    public function addBeneficioCollection($beneficio_id){
        $beneficio=Beneficio::find($beneficio_id);
        $estaAñadido=true;
        foreach($this->beneficios_collection as $beneficioAñadido){if($beneficioAñadido->id==$beneficio_id) $estaAñadido=false;}
        if($estaAñadido)
        {
            $this->beneficios_collection->push($beneficio);
            $this->reset('beneficio_id');
            session()->flash('message', 'Beneficio agregado');
            $this->mensajeForm = ['message'=>session('message'),'color'=>'success'];
        }
        else
        {
            session()->flash('message', 'Beneficio ya está añadido');
            $this->mensajeForm = ['message'=>session('message'),'color'=>'danger'];
        }      
    }

     //FUNCION PARA ELIMINAR ELEMENTOS DEL beneficio_collection
     public function deleteBeneficioCollection($indiceElemento){
        $this->beneficios_collection->pull($indiceElemento); // Elimina el elemento en el índice $indiceElemento y lo devuelve
        session()->flash('message', 'Beneficio eliminado');
        $this->mensajeForm = ['message'=>session('message'),'color'=>'danger'];
    }

    public function imprimir()
    {
        dd($this->beneficios_collection->all());
    }

    //FUNCION PARA REDIRIGIR AL SUBSERVICIO
    public function rediregirProyectos($servicio_id){
        return redirect()->route('proyectos', ['servicio_id' => $servicio_id]);
    }

    //FUNCION PARA CAMBIAR EL ESTADO DEL MODELO
    public function cambiarEstado($id){
        $servicio = Servicio::find($id);
        if($servicio->estado == 1){
            $servicio->update(['estado' => '0']);
            session()->flash('message', 'Servicio desactivado');
            $this->mensajeListado = ['message'=>session('message'),'color'=>'warning'];
        }else{
            $servicio->update(['estado' => '1']);
            session()->flash('message', 'Servicio activado');
            $this->mensajeListado = ['message'=>session('message'),'color'=>'success'];
        }
    }

    //FUNCION PARA CONSULTAR EN BASE DE DATOS Y LLENAR LOS CAMPOS DEL FORMULARIO
    public function edit($id){
        $this->showModal("form", "update");
        $this->servicio=Servicio::find($id);
       /*  $this->ruta_foto_principal=$this->servicio->ruta_foto_principal;
        $this->ruta_foto_secundaria=$this->servicio->ruta_foto_secundaria; */
        $this->foto_principal_guardada = $this->servicio->ruta_foto_principal;
        $this->foto_secundaria_guardada = $this->servicio->ruta_foto_secundaria;
        $this->beneficio_id=-1;
       /*  $this->reset('ruta_foto_principal','ruta_foto_secundaria'); */
    }

    public function update(){
        $this->validate();
        if(!is_null($this->ruta_foto_principal) && $this->ruta_foto_principal!=$this->servicio->ruta_foto_principal) 
        {
            Storage::delete($this->servicio->ruta_foto_principal);
            $this->servicio->ruta_foto_principal = $this->ruta_foto_principal->store('public/servicios/principal');
        }
        if(!is_null($this->ruta_foto_secundaria) && $this->ruta_foto_secundaria!=$this->servicio->ruta_foto_secundaria) 
        {
            Storage::delete($this->servicio->ruta_foto_secundaria);
            $this->servicio->ruta_foto_secundaria = $this->ruta_foto_secundaria->store('public/servicios/secundaria');
        }
        $this->servicio->update();
        session()->flash('message', 'Servicio actualizado con éxito');
        $this->mensajeListado= ['message'=>session('message'),'color'=>'success'];
        $this->dispatchBrowserEvent('closeModal');
    }

    public function saveServicioBeneficio(){
        
        $beneficio_servicio=BeneficioServicio::where('servicio_id',$this->servicio->id)->where('beneficio_id',$this->beneficio_id)->first();
        if(!$beneficio_servicio)
        {
            $servicio=Servicio::find($this->servicio->id);
            $beneficio=Beneficio::find($this->beneficio_id);
            $servicio->beneficios()->attach($beneficio);
            session()->flash('message', 'Beneficio agregado');
            $this->mensajeForm = ['message'=>session('message'),'color'=>'success'];
        }
        else
        {
            session()->flash('message', 'Beneficio ya está añadido');
            $this->mensajeForm = ['message'=>session('message'),'color'=>'danger'];
        }
            
    }

    public function cambiarEstadoBeneficioServicio($id)
    {
        $beneficio_servicio = BeneficioServicio::find($id);
        if($beneficio_servicio->estado == 1){
            $beneficio_servicio->update(['estado' => '0']);
            session()->flash('message', 'Beneficio desactivado');
            $this->mensajeForm = ['message'=>session('message'),'color'=>'warning'];
        }else{
            $beneficio_servicio->update(['estado' => '1']);
            session()->flash('message', 'Beneficio activado');
            $this->mensajeForm = ['message'=>session('message'),'color'=>'success'];
        }
       
    }

    //FUNCIÓN PARA RESETEAR EL LA VARIABLE QUE ALBERGA AL MENSAJE AL PULSAR EN EL CLOSE DEL MENSAJE
    public function resetearMensaje($contenedor_mensaje){
        $this->reset($contenedor_mensaje);
    }

}
