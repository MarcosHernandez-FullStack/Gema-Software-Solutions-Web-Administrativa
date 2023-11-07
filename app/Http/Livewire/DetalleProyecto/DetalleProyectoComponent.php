<?php

namespace App\Http\Livewire\DetalleProyecto;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Proyecto;
use App\Models\DetalleProyecto;
use Illuminate\Support\Facades\Storage;
class DetalleProyectoComponent extends Component
{
    use WithFileUploads;
    public $proyecto,$detalle_proyecto,$ruta_foto,$mensajeForm;
   /*  protected $listeners=['getProyectoId' => 'setProyectoId'];

    public function setProyectoId($proyecto_id){
        $this->proyecto_id = $proyecto_id;
    } */
    
    
   //CONSTRUCTOR EN DONDE SE INICIALIZAN VARIABLES
   public function mount($proyecto)
   {
       $this->proyecto=$proyecto;
       $this->detalle_proyecto = new DetalleProyecto();
   }

    //FUNCION PARA REGISTRAR LAS VALIDACIONES DINAMICAS
    protected function rules(){
        return [
           'detalle_proyecto.nombre' => 'required',
           'ruta_foto' => 'required|image|max:2048',
        ];
   }
   
    //PROPIEDAD PARA PERSONALIZAR MENSAJES DE VALIDACION
    protected $messages = [
        'detalle_proyecto.nombre.required' => 'El campo nombre es requerido',
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

    //FUNCION PARA RENDERIZAR COMPONENTE
    public function render()
    {
        $proyecto=$this->proyecto;
        $detalles_proyecto=DetalleProyecto::where('proyecto_id','=',$this->proyecto->id)->get();
        return view('livewire.detalle-proyecto.detalle-proyecto-component', compact('proyecto','detalles_proyecto'));
    }


     //FUNCION PARA GUARDAR EN BASE DE DATOS
     public function save(){
        $this->validate();
        $this->detalle_proyecto->proyecto_id=$this->proyecto->id;
         //GUARDAR FOTO
         if($this->ruta_foto){
            $this->detalle_proyecto->ruta_foto = $this->ruta_foto->store('public/detalles-proyectos');
        }
        $this->detalle_proyecto->save();
        session()->flash('message', 'Detalle agregado');
        $this->mensajeForm = ['message'=>session('message'),'color'=>'success'];
    }

     //FUNCION PARA CONSULTAR EN BASE DE DATOS Y LLENAR LOS CAMPOS DEL FORMULARIO
     public function edit($id){
        $this->detalle_proyecto=DetalleProyecto::find($id);
    }
     public function delete($id){
        $detalle_proyecto=DetalleProyecto::find($id);
        Storage::delete($detalle_proyecto->ruta_foto);
        $detalle_proyecto->delete();
        session()->flash('message', 'Detalle eliminado');
        $this->mensajeForm = ['message'=>session('message'),'color'=>'danger'];
    }
    //FUNCION PARA CAMBIAR EL ESTADO DEL MODELO
    public function cambiarEstado($id){
        $detalleproyecto = DetalleProyecto::find($id);
        if($detalleproyecto->estado == 1){
            $detalleproyecto->update(['estado' => '0']);
            session()->flash('message', 'Detalle desactivado');
            $this->mensajeForm = ['message'=>session('message'),'color'=>'warning'];
        }else{
            $detalleproyecto->update(['estado' => '1']);
            session()->flash('message', 'Detalle activado');
            $this->mensajeForm = ['message'=>session('message'),'color'=>'success'];
        }
    }

    //FUNCIÓN PARA RESETEAR EL mensajeForm AL PULSAR EN EL CLOSE DEL mensaje
     public function resetearMensajeForm(){
        $this->reset('mensajeForm');
    }
}
