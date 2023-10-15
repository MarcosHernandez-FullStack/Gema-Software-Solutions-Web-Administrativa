<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BienvenidoComponent extends Component
{
    public function render()
    {
        return view('livewire.bienvenido-component')
                ->extends('layouts.principal')
                ->section('content');
    }
}
