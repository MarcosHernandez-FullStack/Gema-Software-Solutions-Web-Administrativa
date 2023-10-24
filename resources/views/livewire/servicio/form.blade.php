@extends('layouts.modal')
@section('contenido_modal')
    <form>
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
                <label for="nombre" class="form-label">
                    Nombre
                </label>
                <input type="text" class="form-control form-control-sm rounded-pill" id="nombre" wire:model='servicio.nombre'>
                @error('servicio.nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="descripcion" class="form-label">
                    Descripción resumida
                </label>
                <textarea type="text" class="form-control form-control-sm rounded-lg" id="descripcion_resumida" wire:model='servicio.descripcion_resumida'>
                </textarea>
                @error('servicio.descripcion_resumida')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="descripcion" class="form-label">
                    Descripción amplia
                </label>
                <textarea type="text" class="form-control form-control-sm rounded-lg" id="descripcion_amplia" wire:model='servicio.descripcion_amplia'>
                </textarea>
                @error('servicio.descripcion_amplia')
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
            @if ($foto_principal_guardada)
            <div  class="form-group col-md-6">
                <label class="form-label text-capitalize">
                    Foto Principal Registrada 
                </label>
                <img src="{{Storage::url($foto_principal_guardada)}}" class="img-thumbnail w-100" alt="foto_guardada">
            </div>
            @endif

            @if ($ruta_foto_principal)
            <div  class="form-group col-md-6">
                {{-- titulo de foto --}}
                <label class="form-label text-capitalize">
                    Foto Principal Nueva
                </label>
                <img src="{{ $ruta_foto_principal->temporaryUrl() }}" class="img-thumbnail w-100" alt="foto">
            </div>
            @endif


            <div class="form-group">
                <label for="foto" class="form-label text-capitalize">
                    Foto secundaria
                </label>
                <input type="file" class="form-control form-control-sm rounded-pill" id="ruta_foto_secundaria" wire:model='ruta_foto_secundaria' >
                @error('ruta_foto_secundaria')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            @if ($foto_secundaria_guardada)
            <div  class="form-group col-md-6">
                <label class="form-label text-capitalize">
                    Foto Secundaria Registrada 
                </label>
                <img src="{{Storage::url($foto_secundaria_guardada)}}" class="img-thumbnail w-100" alt="foto_guardada">
            </div>
            @endif

            @if ($ruta_foto_secundaria)
            <div  class="form-group col-md-6">
                {{-- titulo de foto --}}
                <label class="form-label text-capitalize">
                    Foto Secundaria Nueva
                </label>
                <img src="{{ $ruta_foto_secundaria->temporaryUrl() }}" class="img-thumbnail w-100" alt="foto">
            </div>
            @endif

            @if ($form == 'update')
                <div class="form-group">
                    <label for="descripcion" class="form-label">
                        Beneficios
                    </label>
                    <select class="form-control form-control-sm rounded-pill" id="" wire:model='beneficio_id'>
                        <option value="-1">Seleccionar una opción</option>
                        @foreach ($beneficios as $beneficio)
                            <option value="{{$beneficio->id}}">{{$beneficio->descripcion}}</option>
                        @endforeach 
                    </select>
                    <button type="button" class="btn btn-sm btn-success rounded-pill" wire:click="saveServicioBeneficio()" @if ($beneficio_id==-1) disabled @endif>+ Agregar beneficio</button>
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
                            @forelse ($servicio_obtenido->beneficios as $key => $beneficio)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$beneficio->descripcion}}</td>
                                <td><span role="button"
                                    class="badge rounded-pill bg-{{ $servicio->estado == '1' ? 'success' : 'warning' }}" {{-- wire:click='cambiarEstado({{ $servicio->id }})' --}}>{{ $servicio->estado == '1' ? 'ACTIVO' : 'INACTIVO' }}</span></td>
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
            @endif

            @if ($form == 'save')
            <div class="form-group">
                <label for="descripcion" class="form-label">
                    Beneficios
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
            @endif




        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm rounded-pill btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            <button type="button" class="btn btn-sm rounded-pill btn-info"
                wire:click="{{ $form == 'create' ? 'save' : 'update' }}"
                > <i class="fas fa-save"></i> {{ $form == 'create' ? 'Registrar' : 'Actualizar' }}</button>
        </div>
    </form>
@endsection





