@extends('layouts.modal')
@section('contenido_modal')
    <form wire:submit.prevent="{{ $form == 'create' ? 'save' : 'update' }}">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $form == 'create' ? 'Crear' : 'Editar' }} Sub Servicio
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="descripcion" class="form-label">
                    Descripción
                </label>
                <input type="text" class="form-control" id="descripcion" wire:model='sub_servicio.descripcion'>
                @error('sub_servicio.descripcion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="descripcion" class="form-label">
                   Empresa Cliente
                </label>
                <input type="text" class="form-control" id="empresa_cliente" wire:model='sub_servicio.empresa_cliente'>
                @error('sub_servicio.empresa_cliente')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="descripcion" class="form-label">
                   Fecha Implementación
                </label>
                <input type="date" class="form-control" id="fecha_implementacion" wire:model='sub_servicio.fecha_implementacion'>
                @error('sub_servicio.fecha_implementacion')
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
