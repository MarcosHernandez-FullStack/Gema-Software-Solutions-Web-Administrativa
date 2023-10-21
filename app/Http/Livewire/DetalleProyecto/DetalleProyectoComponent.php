<?php

namespace App\Http\Livewire\DetalleProyecto;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Proyecto;
use App\Models\DetalleProyecto;

class DetalleProyectoComponent extends Component
{
    use WithFileUploads;
    public $proyecto_id,$detalle_proyecto,$ruta_foto;
    
    
   //CONSTRUCTOR EN DONDE SE INICIALIZAN VARIABLES
   public function mount($proyecto_id)
   {
       $this->proyecto_id=$proyecto_id;
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
        'detalle_proyecto.nombre.required' => 'El nombre es requerido',
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

    //FUNCION PARA RENDERIZAR COMPONENTE
    public function render()
    {
        $proyecto=Proyecto::find($this->proyecto_id);
        $detalles_proyecto=DetalleProyecto::where('proyecto_id','=',$this->proyecto_id)->get();
        return view('livewire.detalle-proyecto.detalle-proyecto-component', compact('proyecto','detalles_proyecto'));
    }


     //FUNCION PARA GUARDAR EN BASE DE DATOS
     public function save(){
        $this->validate();
        $this->detalle_proyecto->proyecto_id=$this->proyecto_id;
         //GUARDAR FOTO
         if($this->ruta_foto){
            $this->detalle_proyecto->ruta_foto = $this->ruta_foto->store('public/detalles-proyectos');
        }
        $this->detalle_proyecto->save();
        /* session()->flash('message', 'Detalle de Sub servicio registrado con éxito');
        $this->dispatchBrowserEvent('closeModal'); */
    }
}
