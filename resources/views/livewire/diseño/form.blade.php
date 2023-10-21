@extends('layouts.modal')
@section('contenido_modal')
    <form wire:submit.prevent="{{ $form == 'create' ? 'save' : 'update' }}">
        <div class="modal-header bg-info text-light">
            <h5 class="modal-title">
                {{ $form == 'create' ? 'Crear' : 'Editar' }} Servicio
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
                <input type="text" class="form-control form-control-sm rounded-pill" id="descripcion" wire:model='servicio.descripcion'>
                @error('servicio.descripcion')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="descripcion" class="form-label">
                    Detalle de la descripción resumida
                </label>
                <textarea type="text" class="form-control form-control-sm rounded-lg" id="detalle_descripcion_resumida" wire:model='servicio.detalle_descripcion_resumida'>
                </textarea>
                @error('servicio.detalle_descripcion_resumida')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="descripcion" class="form-label">
                    Detalle de la descripción amplia
                </label>
                <textarea type="text" class="form-control form-control-sm rounded-lg" id="detalle_descripcion_amplia" wire:model='servicio.detalle_descripcion_amplia'>
                </textarea>
                @error('servicio.detalle_descripcion_amplia')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="foto" class="form-label text-capitalize">
                    Foto principal
                </label>
                <input type="file" class="form-control form-control-sm rounded-pill" id="ruta_foto_principal" wire:model='ruta_foto_principal' >
                @error('ruta_foto_principal')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="foto" class="form-label text-capitalize">
                    Foto del detalle
                </label>
                <input type="file" class="form-control form-control-sm rounded-pill" id="ruta_foto_detalle" wire:model='ruta_foto_detalle' >
                @error('ruta_foto_detalle')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="descripcion" class="form-label">
                    Detalle de la descripción amplia
                </label>
                <select class="form-control form-control-sm rounded-pill" id="" wire:model='beneficio_id'>
                    <option value="-1">Seleccionar una opción</option>
                    @foreach ($beneficios as $beneficio)
                        <option value="{{$beneficio->id}}">{{$beneficio->descripcion}}</option>
                    @endforeach 
                </select>
                <button type="button" class="btn btn-sm btn-success rounded-pill" wire:click="addBeneficioCollection({{$beneficio_id}})" @if ($beneficio_id==-1) disabled @endif>+ Agregar beneficio</button>
                <button type="button" class="btn btn-primary" wire:click="imprimir()">Imprimir</button>
            </div>

            <div class="form-group">
                <table class="table table-sm">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Descripción</th>
                        <th>Opción</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($beneficios_collection as $key => $beneficio)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$beneficio->descripcion}}</td>
                                <td><button class="btn btn-sm rounded-pill btn-danger" type="button" wire:click='deleteBeneficioCollection({{$key}})'><i class="fas fa-trash"></i> Eliminar</button></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <p>No hay registros</p>
                                </td>
                            </tr>
                        @endforelse

                      
                      
                    </tbody>
                  </table>
            
            </div>




        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm rounded-pill btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            <button type="submit" class="btn btn-sm rounded-pill btn-info"
                {{-- wire:click="{{ $form == 'create' ? 'save' : 'update' }}" --}}
                > <i class="fas fa-save"></i> {{ $form == 'create' ? 'Registrar' : 'Actualizar' }}</button>
        </div>
    </form>
@endsection
