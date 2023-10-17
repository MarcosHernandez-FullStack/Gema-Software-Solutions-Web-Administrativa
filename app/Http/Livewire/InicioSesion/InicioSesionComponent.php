<?php

namespace App\Http\Livewire\InicioSesion;

use Livewire\Component;

class InicioSesionComponent extends Component
{
    public $email;
    public $password;
    public $remember = false;

    //PROPIEDAD PARA PERSONALIZAR VALIDACION
    protected function rules(){
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    //PROPIEDAD PARA PERSONALIZAR MENSAJES DE VALIDACION
    protected $messages = [
        'email.required' => 'El email es requerido.',
        'email.email' => 'El email debe ser un email valido.',
        'password.required' => 'La password es requerida.'
    ];

    //FUNCION PARA MOSTRAR ERRORES DE VALIDACION EN TIEMPO REAL
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    //FUNCION PARA RENDERIZAR EL COMPONENTE
    public function render()
    {
        return view('livewire.inicio-sesion.inicio-sesion-component')
                    ->extends('layouts.autenticacion-registro')
                    ->section('content')
                    ->layoutData(['titulo' => 'Inicio de sesión']);
    }

    //FUNCION PARA INICIAR SESION
    public function login()
    {
        $validatedData = $this->validate();
        if (auth()->attempt($validatedData)) {
            /* session()->flash('message', 'Te has logueado correctamente.'); */
            return redirect()->route('bienvenido');
        } else {
            /* session()->flash('message', 'Estas credenciales no coinciden con los registros.'); */
        }
    }
}
