@extends('layouts.modal')
@section('contenido_modal')
    <form>
        <div class="modal-header bg-info text-light">
            <h5 class="modal-title">
                {{ $form == 'create' ? 'Crear' : 'Editar' }} Proyecto
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body row">
            <div class="form-group col-md-6">
                <label for="descripcion" class="form-label">
                    Nombre
                </label>
                <input type="text" class="form-control form-control-sm rounded-pill" id="nombre" wire:model='proyecto.nombre'>
                @error('proyecto.nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-4">
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
            <div class="form-group col-md-2">
                <label for="descripcion" class="form-label">
                   Fecha Implementación
                </label>
                <input type="date" class="form-control form-control-sm rounded-pill" id="fecha_implementacion" wire:model='proyecto.fecha_implementacion' min="2018-03-31" max="2041-01-01">
                @error('proyecto.fecha_implementacion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-12">
                <label for="foto" class="form-label text-capitalize">
                    Foto
                </label>
                <input type="file" class="form-control form-control-sm rounded-pill" id="ruta_foto" wire:model='ruta_foto' accept="image/png,image/jpeg">
                @error('ruta_foto')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <div class="row">
                    @if ($foto_guardada)
                        <div class="col-md-6">
                                <label class="form-label text-capitalize">
                                    Foto Guardada 
                                </label>
                                <img src="{{Storage::url($foto_guardada)}}" class="img-thumbnail w-100" alt="foto_guardada">
                        </div>
                    @endif
                    @if ($ruta_foto)
                        <div class="col-md-6">
                                <label class="form-label text-capitalize">
                                    Foto Nueva
                                </label>
                                <img src="{{ $ruta_foto->temporaryUrl() }}" class="img-thumbnail w-100" alt="foto">
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" wire:click="{{ $form == 'create' ? 'save' : 'update' }}">{{ $form == 'create' ? 'Registrar' : 'Actualizar' }}</button>
        </div>
    </form>
@endsection
