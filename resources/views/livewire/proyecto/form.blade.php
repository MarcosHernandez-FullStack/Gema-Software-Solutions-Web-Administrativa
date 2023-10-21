@extends('layouts.modal')
@section('contenido_modal')
    <form wire:submit.prevent="{{ $form == 'create' ? 'save' : 'update' }}">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $form == 'create' ? 'Crear' : 'Editar' }} Proyecto
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="descripcion" class="form-label">
                    Nombre
                </label>
                <input type="text" class="form-control" id="nombre" wire:model='proyecto.nombre'>
                @error('proyecto.nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="descripcion" class="form-label">
                    Empresa cliente
                </label>
                <select class="form-control form-control-sm rounded-pill" id="" wire:model='proyecto.empresa_id'>
                    <option value="-1">Seleccionar una opción</option>
                    @foreach ($empresas as $empresa)
                        <option value="{{$empresa->id}}">{{$empresa->razon_social}}</option>
                    @endforeach 
                </select>
                @error('proyecto.empresa_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="descripcion" class="form-label">
                   Fecha Implementación
                </label>
                <input type="date" class="form-control" id="fecha_implementacion" wire:model='proyecto.fecha_implementacion'>
                @error('proyecto.fecha_implementacion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="foto" class="form-label text-capitalize">
                    Foto
                </label>
                <input type="file" class="form-control" id="ruta_foto" wire:model='ruta_foto' >
                @error('ruta_foto')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary"
                {{-- wire:click="{{ $form == 'create' ? 'save' : 'update' }}" --}}
                >{{ $form == 'create' ? 'Registrar' : 'Actualizar' }}</button>
        </div>
    </form>
@endsection
