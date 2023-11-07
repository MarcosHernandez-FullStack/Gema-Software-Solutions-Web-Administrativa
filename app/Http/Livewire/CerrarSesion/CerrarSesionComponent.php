<?php

namespace App\Http\Livewire\CerrarSesion;

use Livewire\Component;

class CerrarSesionComponent extends Component
{
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
    
    public function render()
    {
        return view('livewire.cerrar-sesion.cerrar-sesion-component');
    }
}
